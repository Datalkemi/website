import React from 'react';
import { motion } from 'framer-motion';
import { Button } from '@/components/ui/button';
import { ArrowRight } from 'lucide-react';

const Hero = () => {
  return (
    <section
      id="hero"
      className="relative min-h-screen flex items-center justify-center py-20 md:py-32 bg-black overflow-hidden"
    >
      {/* Background Video (z-0) */}
      <video
        autoPlay
        muted
        loop
        playsInline
        className="absolute top-0 left-0 w-full h-full object-cover z-0"
      >
        <source src="/videos/hero-bg.mp4" type="video/mp4" />
        Your browser does not support the video tag.
      </video>

      {/* Haze overlay on top of video (z-10) */}
      <div className="absolute inset-0 bg-black/80 backdrop-blur-sm z-10 pointer-events-none"></div>

      {/* Pattern & blur blobs (optional, z-10) */}
      <div className="absolute inset-0 opacity-10 z-10 pointer-events-none">
        <span className="absolute top-1/4 left-1/4 w-64 h-64 bg-primary rounded-full filter blur-3xl opacity-50 animate-pulse"></span>
        <span className="absolute bottom-1/4 right-1/4 w-72 h-72 bg-accent rounded-full filter blur-3xl opacity-50 animate-pulse animation-delay-2000"></span>
        {/* <svg className="absolute inset-0 w-full h-full" xmlns="http://www.w3.org/2000/svg">
          <defs>
            <pattern id="hero-pattern" x="0" y="0" width="80" height="80" patternUnits="userSpaceOnUse" patternTransform="rotate(45)">
              <rect width="2" height="80" fill="hsla(var(--primary), 0.05)" />
              <rect width="80" height="2" fill="hsla(var(--accent), 0.05)" />
            </pattern>
          </defs>
          <rect width="100%" height="100%" fill="url(#hero-pattern)" />
        </svg> */}
      </div>

      {/* Hero Content (z-20) */}
      <div className="container mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-20">
        <div className="container mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-20">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.8, ease: 'easeOut' }}
          >
            <h1 className="text-4xl sm:text-5xl md:text-7xl font-extrabold mb-6 tracking-tight">
              <span className="block text-transparent bg-clip-text bg-gradient-to-r from-primary via-accent to-green-400 leading-tight">
                Datalkemi
              </span>
              <span className="block text-gray-100 mt-2 leading-tight">
                Crafting Digital Excellence.
              </span>
            </h1>
            <h2>

            </h2>
            <p className="text-lg sm:text-xl text-gray-300 max-w-2xl mx-auto mb-10">
              Elevating your online presence with innovative web design & development, powerful in-code SEO, and insightful data analytics & BI solutions.
            </p>
            <motion.div
              initial={{ opacity: 0, scale: 0.8 }}
              animate={{ opacity: 1, scale: 1 }}
              transition={{ duration: 0.5, delay: 0.5, type: 'spring', stiffness: 150 }}
              className="space-x-4"
            >
              <Button size="lg" variant="default" className="group bg-gradient-to-r from-primary to-accent hover:from-accent hover:to-primary transition-all duration-300 transform hover:scale-105 shadow-lg" asChild>
                <a href="#services">
                  Our Services <ArrowRight className="ml-2 h-5 w-5 group-hover:translate-x-1 transition-transform" />
                </a>
              </Button>
              <Button size="lg" variant="outline" className="group border-primary text-primary hover:bg-primary hover:text-primary-foreground transition-all duration-300 transform hover:scale-105 shadow-lg" asChild>
                <a href="#contact">
                  Contact Us
                </a>
              </Button>
            </motion.div>
          </motion.div>
        </div>
      </div>

      {/* Bottom gradient for smooth fade (z-20) */}
      <div className="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-gray-900 to-transparent z-20"></div>
    </section>


  );
};

export default Hero;