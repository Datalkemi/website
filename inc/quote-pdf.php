<?php
/**
 * Project estimate PDF on Datalkemi letterhead.
 *
 * The estimator (assets/js/configurator.js) posts the chosen purpose,
 * currency and option ids. Everything printed here is recalculated from
 * inc/configurator-data.php, so the PDF never trusts prices sent by the
 * browser. The PDF is built with tFPDF (lib/tfpdf, LGPL) using the brand
 * fonts Inter and Space Grotesk (SIL Open Font License).
 *
 * @package Datalkemi
 * @since   2.7.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Rebuilds an estimate from the visitor's selections.
 *
 * @param string $purpose_id Purpose option id, for example 'business'.
 * @param array  $selected   Section key to list of option ids.
 * @param string $currency   AUD, USD or INR.
 * @return array|null Null when the purpose is unknown.
 */
function datalkemi_quote_build( string $purpose_id, array $selected, string $currency ) {
	$data    = datalkemi_get_configurator_data();
	$purpose = null;
	foreach ( $data['purposes']['options'] as $p ) {
		if ( $p['id'] === $purpose_id ) {
			$purpose = $p;
		}
	}
	if ( ! $purpose ) {
		return null;
	}
	if ( ! isset( $data['currencies'][ $currency ] ) ) {
		$currency = 'AUD';
	}

	$lines = [ [
		'section' => 'Project',
		'label'   => $purpose['label'],
		'desc'    => $purpose['desc'],
		'aud'     => ! empty( $purpose['quote'] ) ? null : (int) $purpose['price'],
	] ];
	$total = ! empty( $purpose['quote'] ) ? 0 : (int) $purpose['price'];

	// Short section names for the PDF and emails
	$names = [
		'scale'    => 'Size',
		'design'   => 'Design',
		'content'  => 'Words and photos',
		'features' => 'Extra features',
		'seo'      => 'Google visibility',
		'hosting'  => 'Hosting',
		'support'  => 'Help after launch',
	];
	foreach ( (array) $purpose['steps'] as $key ) {
		if ( empty( $data['sections'][ $key ] ) ) {
			continue;
		}
		$section = $data['sections'][ $key ];
		$section['label'] = $names[ $key ] ?? $section['label'];
		$ids     = array_map( 'strval', (array) ( $selected[ $key ] ?? [] ) );
		foreach ( $section['options'] as $o ) {
			if ( ! in_array( $o['id'], $ids, true ) ) {
				continue;
			}
			if ( ! empty( $o['for'] ) && ! in_array( $purpose['id'], $o['for'], true ) ) {
				continue;
			}
			$price   = isset( $o['prices'][ $purpose['id'] ] ) ? (int) $o['prices'][ $purpose['id'] ] : (int) $o['price'];
			$lines[] = [
				'section' => $section['label'],
				'label'   => $o['label'],
				'desc'    => $o['desc'] ?? '',
				'aud'     => $price,
			];
			$total  += $price;
		}
	}

	return [
		'purpose'   => $purpose['label'],
		'quote'     => ! empty( $purpose['quote'] ),
		'currency'  => $currency,
		'lines'     => $lines,
		'total_aud' => $total,
	];
}

/**
 * An AUD amount in the chosen currency, using the estimator's rates and rounding.
 * Indian rupees are written as "INR" so the PDF fonts never need the rupee sign.
 */
function datalkemi_quote_money( int $aud, string $code ): string {
	$c     = datalkemi_get_configurator_data()['currencies'][ $code ] ?? null;
	if ( ! $c ) {
		return 'A$' . number_format( $aud );
	}
	$step  = max( 1, (int) $c['round'] );
	$value = (int) ( round( $aud * $c['rate'] / $step ) * $step );
	if ( 'INR' === $code ) {
		return 'INR ' . datalkemi_format_inr( $value );
	}
	return $c['symbol'] . number_format( $value );
}

/**
 * Plain text version of the estimate, used in the emails.
 */
function datalkemi_quote_text( array $q ): string {
	$out = [];
	foreach ( $q['lines'] as $l ) {
		$price = null === $l['aud'] ? 'Quote on request' : ( $l['aud'] > 0 ? datalkemi_quote_money( $l['aud'], $q['currency'] ) : 'Included' );
		$out[] = $l['section'] . ': ' . $l['label'] . ' (' . $price . ')';
	}
	$out[] = '';
	$out[] = 'Estimated total: ' . ( $q['quote'] ? 'Quote on request' : datalkemi_quote_money( $q['total_aud'], $q['currency'] ) );
	return implode( "\n", $out );
}

if ( ! defined( 'FPDF_FONTPATH' ) ) {
	define( 'FPDF_FONTPATH', DATALKEMI_DIR . '/lib/tfpdf/font/' );
}

/**
 * Writes the estimate PDF to a temporary file and returns its path.
 *
 * @param array $q      Result of datalkemi_quote_build().
 * @param array $client name, email, company, notes.
 * @param string $number Estimate number.
 * @return string|null File path, or null if the PDF could not be made.
 */
function datalkemi_quote_pdf( array $q, array $client, string $number ) {
	if ( ! class_exists( 'tFPDF' ) ) {
		require_once DATALKEMI_DIR . '/lib/tfpdf/font/unifont/ttfonts.php';
		require_once DATALKEMI_DIR . '/lib/tfpdf/tfpdf.php';
	}
	if ( ! class_exists( 'Datalkemi_Quote_PDF' ) ) {
		datalkemi_quote_pdf_class();
	}

	try {
		$pdf = new Datalkemi_Quote_PDF( 'P', 'mm', 'A4' );
		$pdf->AddFont( 'Inter', '', 'Inter-Regular.ttf', true );
		$pdf->AddFont( 'Inter', 'B', 'Inter-SemiBold.ttf', true );
		$pdf->AddFont( 'Grotesk', '', 'SpaceGrotesk-Medium.ttf', true );
		$pdf->SetMargins( 18, 40, 18 );
		$pdf->SetAutoPageBreak( true, 26 );
		$pdf->AliasNbPages();
		$pdf->SetTitle( 'Datalkemi project estimate ' . $number, true );
		$pdf->SetAuthor( 'Datalkemi', true );
		$pdf->AddPage();
		$pdf->render_estimate( $q, $client, $number );

		$file = trailingslashit( get_temp_dir() ) . 'Datalkemi-estimate-' . $number . '.pdf';
		$pdf->Output( 'F', $file );
		return file_exists( $file ) ? $file : null;
	} catch ( \Throwable $e ) {
		error_log( 'Datalkemi estimate PDF failed: ' . $e->getMessage() );
		return null;
	}
}

/**
 * Declares the letterhead class once tFPDF is loaded.
 */
function datalkemi_quote_pdf_class() {
	class Datalkemi_Quote_PDF extends tFPDF {

		const INK    = [ 2, 45, 63 ];
		const AZURE  = [ 6, 136, 192 ];
		const MUTED  = [ 74, 98, 112 ];
		const RULE   = [ 214, 228, 236 ];
		const PAPER  = [ 245, 250, 253 ];

		private function rgb( array $c, string $what = 'text' ) {
			if ( 'fill' === $what ) {
				$this->SetFillColor( $c[0], $c[1], $c[2] );
			} elseif ( 'draw' === $what ) {
				$this->SetDrawColor( $c[0], $c[1], $c[2] );
			} else {
				$this->SetTextColor( $c[0], $c[1], $c[2] );
			}
		}

		/** Letterhead: wordmark on the left, contact details on the right, azure rule. */
		public function Header() {
			$logo = DATALKEMI_DIR . '/assets/brand/pdf-letterhead-logo.png';
			if ( file_exists( $logo ) ) {
				$this->Image( $logo, 18, 13, 56 );
			}
			$this->SetFont( 'Inter', '', 8.5 );
			$this->rgb( self::MUTED );
			$lines = [ 'datalkemi.com', 'info@datalkemi.com', 'Perth, Western Australia' ];
			$y     = 13.5;
			foreach ( $lines as $l ) {
				$this->SetXY( 110, $y );
				$this->Cell( 82, 4.4, $l, 0, 0, 'R' );
				$y += 4.4;
			}
			$this->rgb( self::AZURE, 'draw' );
			$this->SetLineWidth( 0.6 );
			$this->Line( 18, 30, 192, 30 );
			$this->SetY( 40 );
		}

		/** Footer: business line and page number above a thin rule. */
		public function Footer() {
			$this->rgb( self::RULE, 'draw' );
			$this->SetLineWidth( 0.2 );
			$this->Line( 18, 281, 192, 281 );
			$this->SetXY( 18, 283 );
			$this->SetFont( 'Inter', '', 7.5 );
			$this->rgb( self::MUTED );
			$left = 'Datalkemi  |  info@datalkemi.com  |  datalkemi.com';
			if ( defined( 'DATALKEMI_ABN' ) && '' !== DATALKEMI_ABN ) {
				$left .= '  |  ABN ' . DATALKEMI_ABN;
			}
			$this->Cell( 140, 4, $left, 0, 0, 'L' );
			$this->Cell( 34, 4, 'Page ' . $this->PageNo() . ' of {nb}', 0, 0, 'R' );
		}

		/** Splits text into lines that fit a width at the current font. */
		private function wrap( string $text, float $w ): array {
			$lines = [];
			foreach ( preg_split( "/\r\n|\n/", $text ) as $para ) {
				$line = '';
				foreach ( preg_split( '/\s+/', trim( $para ) ) as $word ) {
					$try = '' === $line ? $word : $line . ' ' . $word;
					if ( $this->GetStringWidth( $try ) <= $w || '' === $line ) {
						$line = $try;
					} else {
						$lines[] = $line;
						$line    = $word;
					}
				}
				$lines[] = $line;
			}
			return $lines;
		}

		private function text_block( string $text, float $x, float $w, float $lh ) {
			foreach ( $this->wrap( $text, $w ) as $l ) {
				$this->SetX( $x );
				$this->Cell( $w, $lh, $l, 0, 1, 'L' );
			}
		}

		private function eyebrow( string $text ) {
			$this->SetFont( 'Inter', 'B', 7.5 );
			$this->rgb( self::AZURE );
			$this->Cell( 0, 4, strtoupper( $text ), 0, 1, 'L' );
		}

		public function render_estimate( array $q, array $client, string $number ) {
			$money = function ( $aud ) use ( $q ) {
				return datalkemi_quote_money( (int) $aud, $q['currency'] );
			};

			// Title
			$this->eyebrow( 'Project estimate' );
			$this->Ln( 1.5 );
			$this->SetFont( 'Grotesk', '', 21 );
			$this->rgb( self::INK );
			$this->Cell( 0, 9, $q['purpose'], 0, 1, 'L' );
			$this->Ln( 5 );

			// Prepared for, and estimate details
			$top = $this->GetY();
			$this->rgb( self::PAPER, 'fill' );
			$this->rgb( self::RULE, 'draw' );
			$this->SetLineWidth( 0.2 );
			$this->Rect( 18, $top, 174, 33, 'DF' );

			$this->SetXY( 24, $top + 5 );
			$this->eyebrow( 'Prepared for' );
			$this->SetX( 24 );
			$this->SetFont( 'Inter', 'B', 10.5 );
			$this->rgb( self::INK );
			$this->Cell( 80, 5.5, $client['name'], 0, 1, 'L' );
			$this->SetFont( 'Inter', '', 9 );
			$this->rgb( self::MUTED );
			foreach ( array_filter( [ $client['company'], $client['email'] ] ) as $l ) {
				$this->SetX( 24 );
				$this->Cell( 80, 4.8, $l, 0, 1, 'L' );
			}

			$c    = datalkemi_get_configurator_data()['currencies'][ $q['currency'] ];
			$meta = [
				'Estimate number' => $number,
				'Date'            => wp_date( 'j F Y' ),
				'Valid until'     => wp_date( 'j F Y', time() + 30 * DAY_IN_SECONDS ),
				'Currency'        => $c['name'] . ' (' . $q['currency'] . ')',
			];
			$y = $top + 5;
			foreach ( $meta as $k => $v ) {
				$this->SetXY( 112, $y );
				$this->SetFont( 'Inter', '', 8.5 );
				$this->rgb( self::MUTED );
				$this->Cell( 32, 5.6, $k, 0, 0, 'L' );
				$this->SetFont( 'Inter', 'B', 8.5 );
				$this->rgb( self::INK );
				$this->Cell( 42, 5.6, $v, 0, 0, 'R' );
				$y += 5.9;
			}
			$this->SetY( $top + 33 + 9 );

			// Line items
			$cols = [ 42, 98, 34 ];
			$this->rgb( self::INK, 'fill' );
			$this->SetTextColor( 255, 255, 255 );
			$this->SetFont( 'Inter', 'B', 8.5 );
			$this->Cell( $cols[0], 8, '  Section', 0, 0, 'L', true );
			$this->Cell( $cols[1], 8, 'What is included', 0, 0, 'L', true );
			$this->Cell( $cols[2], 8, 'Price  ', 0, 1, 'R', true );

			$prev_section = '';
			foreach ( $q['lines'] as $line ) {
				$this->SetFont( 'Inter', '', 8.5 );
				$desc_lines = $line['desc'] ? $this->wrap( $line['desc'], $cols[1] - 4 ) : [];
				$h          = 2.4 + 5 + count( $desc_lines ) * 3.9 + 2.6;
				if ( $this->GetY() + $h > 268 ) {
					$this->AddPage();
				}
				$y0 = $this->GetY();

				if ( $line['section'] !== $prev_section ) {
					$this->SetXY( 18, $y0 + 2.6 );
					$this->SetFont( 'Inter', 'B', 8 );
					$this->rgb( self::AZURE );
					$this->text_block( $line['section'], 20, $cols[0] - 6, 4.3 );
				}
				$prev_section = $line['section'];

				$this->SetXY( 18 + $cols[0], $y0 + 2.2 );
				$this->SetFont( 'Inter', 'B', 10 );
				$this->rgb( self::INK );
				$this->Cell( $cols[1], 5.5, $line['label'], 0, 1, 'L' );
				$this->SetFont( 'Inter', '', 8.5 );
				$this->rgb( self::MUTED );
				foreach ( $desc_lines as $dl ) {
					$this->SetX( 18 + $cols[0] );
					$this->Cell( $cols[1], 3.9, $dl, 0, 1, 'L' );
				}

				$price = null === $line['aud'] ? 'Quote on request' : ( $line['aud'] > 0 ? $money( $line['aud'] ) : 'Included' );
				$this->SetXY( 18 + $cols[0] + $cols[1], $y0 + 2.2 );
				$this->SetFont( 'Inter', 'B', 10 );
				$line['aud'] > 0 ? $this->rgb( self::INK ) : $this->rgb( self::AZURE );
				$this->Cell( $cols[2] - 2, 5.5, $price, 0, 0, 'R' );

				$y1 = max( $this->GetY(), $y0 + $h );
				$this->rgb( self::RULE, 'draw' );
				$this->SetLineWidth( 0.2 );
				$this->Line( 18, $y1, 192, $y1 );
				$this->SetY( $y1 );
			}

			// Total band
			if ( $this->GetY() + 40 > 268 ) {
				$this->AddPage();
			}
			$this->Ln( 4 );
			$this->rgb( self::INK, 'fill' );
			$yt = $this->GetY();
			$this->Rect( 18, $yt, 174, 15, 'F' );
			$this->SetXY( 24, $yt + 4.5 );
			$this->SetTextColor( 255, 255, 255 );
			$this->SetFont( 'Inter', 'B', 10 );
			$this->Cell( 80, 6, 'Estimated total', 0, 0, 'L' );
			$this->SetFont( 'Grotesk', '', 16 );
			$this->Cell( 82, 6, $q['quote'] ? 'Quote on request' : $money( $q['total_aud'] ), 0, 1, 'R' );
			$this->SetY( $yt + 15 + 3 );

			$this->SetFont( 'Inter', '', 8 );
			$this->rgb( self::MUTED );
			if ( 'AUD' === $q['currency'] ) {
				$basis = 'Prices are in Australian dollars and exclude GST.';
			} elseif ( 'INR' === $q['currency'] ) {
				$basis = 'Prices are in Indian rupees at our pricing for clients in India.';
			} else {
				$basis = 'Prices are approximate, converted from Australian dollars.';
			}
			$this->text_block( $basis . ' This estimate is based on the options you chose online and is valid for 30 days.', 18, 174, 4.3 );
			$this->Ln( 6 );

			// Client notes
			if ( ! empty( $client['notes'] ) ) {
				$this->eyebrow( 'Your notes' );
				$this->Ln( 1 );
				$this->SetFont( 'Inter', '', 9 );
				$this->rgb( self::INK );
				$this->text_block( $client['notes'], 18, 174, 4.8 );
				$this->Ln( 6 );
			}

			// Next steps
			if ( $this->GetY() + 40 > 268 ) {
				$this->AddPage();
			}
			$this->eyebrow( 'What happens next' );
			$this->Ln( 2 );
			$steps = [
				'We review your choices and reply within one business day.',
				'We have a free 30-minute call to confirm what you need.',
				'You receive a fixed written quote. Work starts only once you approve it.',
			];
			foreach ( $steps as $i => $s ) {
				$y = $this->GetY();
				$this->SetFont( 'Grotesk', '', 11 );
				$this->rgb( self::AZURE );
				$this->SetXY( 18, $y );
				$this->Cell( 9, 5.5, (string) ( $i + 1 ), 0, 0, 'L' );
				$this->SetFont( 'Inter', '', 9.5 );
				$this->rgb( self::INK );
				$this->text_block( $s, 27, 165, 5.5 );
				$this->Ln( 1.5 );
			}
			$this->Ln( 4 );
			$this->SetFont( 'Inter', '', 9 );
			$this->rgb( self::MUTED );
			$this->text_block( 'Questions? Reply to the email this estimate came with, or write to info@datalkemi.com.', 18, 174, 4.8 );
		}
	}
}
