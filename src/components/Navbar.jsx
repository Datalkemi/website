import React, { useState, useEffect } from 'react';
    import { motion } from 'framer-motion';
    import { Button } from '@/components/ui/button';
    import { Menu, X, Code } from 'lucide-react';

    const Navbar = ({ activeSection }) => {
      const [isOpen, setIsOpen] = useState(false);
      const [isScrolled, setIsScrolled] = useState(false);

      const navItems = [
        { name: 'Home', href: '#hero' },
        { name: 'About', href: '#about' },
        { name: 'Services', href: '#services' },
        { name: 'Tech', href: '#tech-stack' },
        { name: 'Projects', href: '#projects' },
        { name: 'Testimonials', href: '#testimonials' },
        { name: 'Insights', href: '#blog-preview' },
        { name: 'Contact', href: '#contact' },
      ];

      const toggleMenu = () => setIsOpen(!isOpen);

      useEffect(() => {
        const handleScroll = () => {
          setIsScrolled(window.scrollY > 20);
        };
        window.addEventListener('scroll', handleScroll);
        return () => window.removeEventListener('scroll', handleScroll);
      }, []);

      return (
        <motion.nav
          initial={{ y: -100 }}
          animate={{ y: 0 }}
          transition={{ duration: 0.5, ease: 'easeOut' }}
          className={`sticky top-0 z-50 transition-all duration-300 ${
            isScrolled || isOpen ? 'bg-gray-900/90 backdrop-blur-md shadow-lg' : 'bg-transparent'
          }`}
        >
          <div className="container mx-auto px-4 sm:px-6 lg:px-8">
            <div className="flex items-center justify-between h-20">
              <motion.div
                initial={{ opacity: 0, x: -20 }}
                animate={{ opacity: 1, x: 0 }}
                transition={{ duration: 0.5, delay: 0.2 }}
                className="flex items-center"
              >
                <Code className="h-8 w-8 text-primary mr-2" />
                <span className="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-primary via-accent to-green-400">
                  Datalkemi
                </span>
              </motion.div>

              <div className="hidden md:flex items-center space-x-1 lg:space-x-2">
                {navItems.map((item, index) => (
                  <motion.a
                    key={item.name}
                    href={item.href}
                    className={`text-gray-300 hover:text-primary transition-colors duration-300 px-3 py-2 rounded-md text-sm font-medium relative ${
                      activeSection === item.href.substring(1) ? 'text-primary' : ''
                    }`}
                    whileHover={{ scale: 1.05, color: 'hsl(var(--primary))' }}
                    transition={{ type: 'spring', stiffness: 300 }}
                    initial={{ opacity: 0, y: -10 }}
                    animate={{ opacity: 1, y: 0 }}
                    exit={{ opacity: 0, y: -10 }}
                    custom={index}
                    variants={{
                      animate: (i) => ({
                        opacity: 1,
                        y: 0,
                        transition: { duration: 0.3, delay: 0.1 * i + 0.3 },
                      }),
                    }}
                  >
                    {item.name}
                    {activeSection === item.href.substring(1) && (
                      <motion.span
                        layoutId="activePill"
                        className="absolute inset-x-0 bottom-0 h-0.5 bg-primary rounded-t-full"
                        initial={false}
                        transition={{ type: 'spring', stiffness: 500, damping: 30 }}
                      />
                    )}
                  </motion.a>
                ))}
              </div>

              <div className="md:hidden">
                <Button
                  variant="ghost"
                  size="icon"
                  onClick={toggleMenu}
                  aria-label="Toggle menu"
                >
                  {isOpen ? <X className="h-6 w-6 text-primary" /> : <Menu className="h-6 w-6 text-primary" />}
                </Button>
              </div>
            </div>
          </div>

          {isOpen && (
            <motion.div
              initial={{ opacity: 0, height: 0 }}
              animate={{ opacity: 1, height: 'auto' }}
              exit={{ opacity: 0, height: 0 }}
              transition={{ duration: 0.3, ease: 'easeInOut' }}
              className="md:hidden bg-gray-800/95 backdrop-blur-sm pb-3"
            >
              <div className="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                {navItems.map((item) => (
                  <a
                    key={item.name}
                    href={item.href}
                    onClick={() => {
                      toggleMenu();
                      // Smooth scroll for mobile
                      document.querySelector(item.href)?.scrollIntoView({ behavior: 'smooth' });
                    }}
                    className={`text-gray-300 hover:bg-gray-700 hover:text-primary block px-3 py-2 rounded-md text-base font-medium ${
                      activeSection === item.href.substring(1) ? 'bg-gray-700 text-primary' : ''
                    }`}
                  >
                    {item.name}
                  </a>
                ))}
              </div>
            </motion.div>
          )}
        </motion.nav>
      );
    };

    export default Navbar;