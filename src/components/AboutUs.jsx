import React from 'react';
    import { motion } from 'framer-motion';
    import { Users, Target, Zap, CheckCircle } from 'lucide-react';

    const AboutUs = () => {
      const sectionVariants = {
        hidden: { opacity: 0 },
        visible: { 
          opacity: 1,
          transition: { staggerChildren: 0.2, delayChildren: 0.1 }
        }
      };

      const itemVariants = {
        hidden: { opacity: 0, y: 20 },
        visible: { opacity: 1, y: 0, transition: { duration: 0.6, ease: "easeOut" } }
      };

      const usps = [
        "Client-Centric Approach: Your success is our priority.",
        "Innovative Solutions: Leveraging cutting-edge technologies.",
        "Transparent Communication: Keeping you informed every step.",
        "Quality Driven: Delivering excellence in every project.",
        "Data-Powered Insights: Making decisions based on facts."
      ];

      return (
        <section id="about" className="py-20 md:py-28 bg-gray-900 text-gray-100">
          <div className="container mx-auto px-4 sm:px-6 lg:px-8">
            <motion.div
              initial="hidden"
              whileInView="visible"
              viewport={{ once: true, amount: 0.2 }}
              variants={sectionVariants}
            >
              <motion.div variants={itemVariants} className="text-center mb-16">
                <h2 className="text-3xl sm:text-4xl lg:text-5xl font-bold mb-4">
                  <span className="text-transparent bg-clip-text bg-gradient-to-r from-primary via-accent to-green-400">About Datalkemi</span>
                </h2>
                <p className="text-lg text-gray-300 max-w-2xl mx-auto">
                  Pioneering digital transformation through expert web development and insightful data analytics.
                </p>
              </motion.div>

              <div className="grid md:grid-cols-2 gap-12 items-center">
                <motion.div variants={itemVariants}>
                  <h3 className="text-2xl font-semibold text-primary mb-4 flex items-center">
                    <Users className="mr-3 h-7 w-7" /> Our Story
                  </h3>
                  <p className="text-gray-300 leading-relaxed mb-6">
                    Datalkemi was founded with a singular vision: to empower businesses by bridging the gap between innovative technology and actionable intelligence. We are a team of passionate developers, designers, and data scientists dedicated to crafting bespoke digital solutions that drive growth and efficiency. Our journey is fueled by a relentless pursuit of excellence and a commitment to our clients' success.
                  </p>
                  <div className="space-y-6">
                    <div>
                      <h4 className="text-xl font-semibold text-accent mb-2 flex items-center">
                        <Target className="mr-2 h-6 w-6" /> Our Mission
                      </h4>
                      <p className="text-gray-300 leading-relaxed">
                        To deliver exceptional digital experiences and data-driven strategies that enable businesses to thrive in an ever-evolving technological landscape.
                      </p>
                    </div>
                    <div>
                      <h4 className="text-xl font-semibold text-accent mb-2 flex items-center">
                        <Zap className="mr-2 h-6 w-6" /> Our Vision
                      </h4>
                      <p className="text-gray-300 leading-relaxed">
                        To be a leading partner in digital innovation, recognized for our expertise, integrity, and transformative impact on businesses globally.
                      </p>
                    </div>
                  </div>
                </motion.div>

                <motion.div variants={itemVariants} className="glassmorphism p-8 rounded-xl">
                  <h3 className="text-2xl font-semibold text-primary mb-6">Why Choose Us?</h3>
                  <ul className="space-y-4">
                    {usps.map((usp, index) => (
                      <motion.li 
                        key={index} 
                        className="flex items-start"
                        custom={index}
                        initial={{ opacity: 0, x: -20 }}
                        whileInView={{ opacity: 1, x: 0 }}
                        viewport={{ once: true }}
                        transition={{ delay: 0.2 + index * 0.1, duration: 0.5 }}
                      >
                        <CheckCircle className="h-6 w-6 text-green-400 mr-3 mt-1 flex-shrink-0" />
                        <span className="text-gray-200">{usp}</span>
                      </motion.li>
                    ))}
                  </ul>
                </motion.div>
              </div>
            </motion.div>
          </div>
        </section>
      );
    };

    export default AboutUs;