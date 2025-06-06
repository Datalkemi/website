import React from 'react';
    import { motion } from 'framer-motion';
    import { Code, Linkedin, Github, Instagram, ArrowUpCircle } from 'lucide-react';

    const Footer = () => {
      const currentYear = new Date().getFullYear();

      const socialLinks = [
        { icon: <Github className="h-5 w-5" />, href: "https://github.com", label: "GitHub" },
        { icon: <Linkedin className="h-5 w-5" />, href: "https://linkedin.com", label: "LinkedIn" },
        { icon: <Instagram className="h-5 w-5" />, href: "https://instagram.com", label: "Instagram" },
      ];

      const quickLinks = [
        { name: 'About', href: '#about' },
        { name: 'Services', href: '#services' },
        { name: 'Projects', href: '#projects' },
        { name: 'Contact', href: '#contact' },
      ];

      const scrollToTop = () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
      };

      return (
        <motion.footer 
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          transition={{ duration: 0.8, delay: 0.5 }}
          className="bg-gray-900 border-t border-gray-700/50 py-12 text-gray-400 relative"
        >
          <div className="container mx-auto px-4 sm:px-6 lg:px-8">
            <div className="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8 mb-8">
              
              <div className="md:col-span-1 lg:col-span-1">
                <div className="flex items-center mb-4">
                  <Code className="h-8 w-8 text-primary mr-2" />
                  <span className="text-2xl font-semibold text-gray-100">Datalkemi</span>
                </div>
                <p className="text-sm">Crafting digital excellence and data-driven solutions to elevate your business.</p>
              </div>

              <div>
                <p className="font-semibold text-gray-200 mb-3">Quick Links</p>
                <ul className="space-y-2">
                  {quickLinks.map(link => (
                    <li key={link.name}>
                      <a href={link.href} className="hover:text-primary transition-colors text-sm">{link.name}</a>
                    </li>
                  ))}
                </ul>
              </div>
              
              <div>
                <p className="font-semibold text-gray-200 mb-3">Legal</p>
                <ul className="space-y-2">
                  <li><a href="#" className="hover:text-primary transition-colors text-sm">Privacy Policy (Placeholder)</a></li>
                  <li><a href="#" className="hover:text-primary transition-colors text-sm">Terms of Service (Placeholder)</a></li>
                </ul>
              </div>

              <div>
                <p className="font-semibold text-gray-200 mb-3">Connect</p>
                <div className="flex space-x-4 mb-3">
                  {socialLinks.map((link, index) => (
                    <motion.a
                      key={index}
                      href={link.href}
                      target="_blank"
                      rel="noopener noreferrer"
                      aria-label={link.label}
                      className="text-gray-400 hover:text-primary transition-colors duration-300"
                      whileHover={{ scale: 1.2, y: -2 }}
                      transition={{ type: 'spring', stiffness: 300 }}
                    >
                      {link.icon}
                    </motion.a>
                  ))}
                </div>
                <a href="mailto:info@datalkemi.com" className="text-sm hover:text-primary transition-colors">info@datalkemi.com</a>
              </div>

            </div>
            
            <div className="mt-8 pt-8 border-t border-gray-700/30 text-center">
              <p className="text-sm">
                &copy; {currentYear} Datalkemi. All rights reserved.
              </p>
              <p className="text-xs text-gray-500 mt-2">
                Built with <span className="text-primary">&hearts;</span> and cutting-edge technology.
              </p>
            </div>
          </div>
          <motion.button
            onClick={scrollToTop}
            className="absolute bottom-6 right-6 bg-primary/80 hover:bg-primary text-white p-3 rounded-full shadow-lg"
            aria-label="Scroll to top"
            whileHover={{ scale: 1.1, rotate: 360 }}
            whileTap={{ scale: 0.9 }}
            transition={{ type: "spring", stiffness: 300, duration: 0.5 }}
          >
            <ArrowUpCircle className="h-6 w-6" />
          </motion.button>
        </motion.footer>
      );
    };

    export default Footer;