import React from 'react';
    import { motion } from 'framer-motion';
    import { Card, CardContent, CardFooter, CardHeader } from '@/components/ui/card';
    import { Star, UserCircle } from 'lucide-react';

    const testimonialsData = [
      {
        name: "Sarah L., CEO of TechSolutions Inc.",
        rating: 5,
        review: "Datalkemi transformed our online presence. Their team is professional, skilled, and delivered beyond our expectations. The new website and analytics dashboard are game-changers for us!",
        avatarPlaceholder: "Professional woman in business attire"
      },
      {
        name: "John B., Marketing Director at Innovate Ltd.",
        rating: 5,
        review: "Working with Datalkemi was a fantastic experience. They understood our needs perfectly and provided excellent web development and SEO services. Our organic traffic has significantly increased.",
        avatarPlaceholder: "Man smiling confidently"
      },
      {
        name: "Emily K., Founder of EcoGoods Co.",
        rating: 4,
        review: "We're thrilled with the custom e-commerce solution Datalkemi built for us. Their attention to detail and commitment to quality are commendable. Highly recommended for any web project.",
        avatarPlaceholder: "Young entrepreneur in a casual setting"
      },
    ];

    const cardVariants = {
      hidden: { opacity: 0, y: 50, scale: 0.9 },
      visible: (i) => ({
        opacity: 1,
        y: 0,
        scale: 1,
        transition: {
          delay: i * 0.15,
          duration: 0.6,
          ease: 'easeOut',
        },
      }),
    };

    const Testimonials = () => {
      return (
        <section id="testimonials" className="py-20 md:py-28 bg-gray-900">
          <div className="container mx-auto px-4 sm:px-6 lg:px-8">
            <motion.div
              initial={{ opacity: 0, y: -20 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true, amount: 0.3 }}
              transition={{ duration: 0.7, ease: 'easeOut' }}
              className="text-center mb-16"
            >
              <h2 className="text-3xl sm:text-4xl lg:text-5xl font-bold mb-4">
                <span className="text-transparent bg-clip-text bg-gradient-to-r from-primary via-accent to-green-400">Client Testimonials</span>
              </h2>
              <p className="text-lg text-gray-300 max-w-2xl mx-auto">
                Hear what our satisfied clients have to say about their experience with Datalkemi.
              </p>
            </motion.div>

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
              {testimonialsData.map((testimonial, index) => (
                <motion.custom
                  key={index}
                  custom={index}
                  initial="hidden"
                  whileInView="visible"
                  viewport={{ once: true, amount: 0.2 }}
                  variants={cardVariants}
                  as={motion.div} 
                  className="h-full"
                >
                  <Card className="h-full flex flex-col glassmorphism border-primary/20 hover:shadow-xl hover:shadow-primary/15 transition-all duration-300 overflow-hidden">
                    <CardHeader className="pb-4">
                      <div className="flex items-center mb-3">
                        <div className="w-12 h-12 rounded-full bg-gray-700 mr-4 flex items-center justify-center">
                          <img  
                            alt={testimonial.name} 
                            className="w-10 h-10 rounded-full object-cover text-gray-400"
                           src="https://images.unsplash.com/photo-1693042766870-fc4293fd1ab9" />
                        </div>
                        <div>
                          <p className="font-semibold text-gray-100">{testimonial.name.split(',')[0]}</p>
                          <p className="text-xs text-gray-400">{testimonial.name.split(',')[1]?.trim()}</p>
                        </div>
                      </div>
                      <div className="flex items-center">
                        {[...Array(5)].map((_, i) => (
                          <Star
                            key={i}
                            className={`h-5 w-5 ${i < testimonial.rating ? 'text-yellow-400 fill-yellow-400' : 'text-gray-500'}`}
                          />
                        ))}
                      </div>
                    </CardHeader>
                    <CardContent className="flex-grow">
                      <p className="text-gray-300 leading-relaxed italic">"{testimonial.review}"</p>
                    </CardContent>
                     <CardFooter className="pt-4 mt-auto text-xs text-gray-500">
                      Verified Client Feedback
                    </CardFooter>
                  </Card>
                </motion.custom>
              ))}
            </div>
          </div>
        </section>
      );
    };

    export default Testimonials;