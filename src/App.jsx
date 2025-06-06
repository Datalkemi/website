import React, { useEffect, useState } from 'react';
    import { Toaster } from '@/components/ui/toaster';
    import Navbar from '@/components/Navbar';
    import Hero from '@/components/Hero';
    import AboutUs from '@/components/AboutUs.jsx';
    import Services from '@/components/Services';
    import TechStack from '@/components/TechStack.jsx';
    import ProjectHighlights from '@/components/ProjectHighlights.jsx';
    import Testimonials from '@/components/Testimonials.jsx';
    import BlogPreview from '@/components/BlogPreview.jsx';
    import Contact from '@/components/Contact';
    import Footer from '@/components/Footer';
    import { motion } from 'framer-motion';

    function App() {
      const [activeSection, setActiveSection] = useState('hero');

      useEffect(() => {
        const sections = document.querySelectorAll('section[id]');
        const observer = new IntersectionObserver(
          (entries) => {
            entries.forEach(entry => {
              if (entry.isIntersecting) {
                setActiveSection(entry.target.id);
              }
            });
          },
          { rootMargin: "-50% 0px -50% 0px" } 
        );
    
        sections.forEach(section => observer.observe(section));
    
        return () => sections.forEach(section => observer.unobserve(section));
      }, []);

      return (
        <div className="min-h-screen bg-gray-900 text-gray-100 flex flex-col">
          <Navbar activeSection={activeSection} />
          <main className="flex-grow">
            <Hero />
            <AboutUs />
            <Services />
            <TechStack />
            <ProjectHighlights />
            <Testimonials />
            <BlogPreview />
            <Contact />
          </main>
          <Footer />
          <Toaster />
        </div>
      );
    }

    export default App;