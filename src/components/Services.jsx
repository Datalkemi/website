import React from 'react';
    import { motion } from 'framer-motion';
    import { Card, CardHeader, CardTitle, CardDescription, CardContent } from '@/components/ui/card';
    import { Code, BarChart3, Search, Palette, Layers, Database, TrendingUp, BarChartHorizontalBig } from 'lucide-react';

    const servicesData = [
      {
        icon: <Palette className="h-10 w-10 text-primary mb-4" />,
        title: 'Website Design',
        description: 'Crafting visually stunning, user-centric designs that reflect your brand and engage your audience effectively.',
      },
      {
        icon: <Code className="h-10 w-10 text-primary mb-4" />,
        title: 'Full-Stack Web Development',
        description: 'Building robust, scalable, and high-performance websites and applications from frontend to backend.',
      },
      {
        icon: <Search className="h-10 w-10 text-primary mb-4" />,
        title: 'In-Code SEO Optimization',
        description: 'Integrating SEO best practices directly into your website’s architecture for enhanced visibility and ranking.',
      },
      {
        icon: <BarChart3 className="h-10 w-10 text-primary mb-4" />,
        title: 'Data Analytics Solutions',
        description: 'Transforming complex data into actionable insights to drive informed business decisions and growth strategies.',
      },
      {
        icon: <Layers className="h-10 w-10 text-primary mb-4" />,
        title: 'Business Intelligence & Reporting',
        description: 'Developing comprehensive BI solutions and interactive reports to monitor performance and uncover opportunities.',
      },
      {
        icon: <BarChartHorizontalBig className="h-10 w-10 text-primary mb-4" />,
        title: 'Custom Dashboards',
        description: 'Creating tailored dashboards that provide a clear, real-time view of your key performance indicators.',
      },
    ];

    const cardVariants = {
      hidden: { opacity: 0, y: 50 },
      visible: (i) => ({
        opacity: 1,
        y: 0,
        transition: {
          delay: i * 0.1,
          duration: 0.5,
          ease: 'easeOut',
        },
      }),
    };

    const Services = () => {
      return (
        <section id="services" className="py-20 md:py-28 bg-gray-800/30">
          <div className="container mx-auto px-4 sm:px-6 lg:px-8">
            <motion.div
              initial={{ opacity: 0, y: -20 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true, amount: 0.3 }}
              transition={{ duration: 0.7, ease: 'easeOut' }}
              className="text-center mb-16"
            >
              <h2 className="text-3xl sm:text-4xl lg:text-5xl font-bold mb-4">
                <span className="text-transparent bg-clip-text bg-gradient-to-r from-primary via-accent to-green-400">Our Expertise</span>
              </h2>
              <p className="text-lg text-gray-300 max-w-2xl mx-auto">
                We provide a wide array of services designed to elevate your business in the digital and data-driven landscape.
              </p>
            </motion.div>

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
              {servicesData.map((service, index) => (
                <motion.custom
                  key={index}
                  custom={index}
                  initial="hidden"
                  whileInView="visible"
                  viewport={{ once: true, amount: 0.2 }}
                  variants={cardVariants}
                  className="h-full"
                  as={motion.div} 
                >
                  <Card className="h-full glassmorphism border-primary/30 hover:border-primary transition-all duration-300 ease-in-out transform hover:scale-105 hover:shadow-2xl hover:shadow-primary/20 flex flex-col overflow-hidden">
                    <CardHeader className="items-center text-center pt-8">
                      {service.icon}
                      <CardTitle className="text-2xl font-semibold text-gray-100">{service.title}</CardTitle>
                    </CardHeader>
                    <CardContent className="flex-grow p-6">
                      <CardDescription className="text-gray-300 text-center leading-relaxed">
                        {service.description}
                      </CardDescription>
                    </CardContent>
                  </Card>
                </motion.custom>
              ))}
            </div>
          </div>
        </section>
      );
    };

    export default Services;