import React from 'react';
    import { motion } from 'framer-motion';
    import { Card, CardContent, CardFooter, CardHeader, CardTitle, CardDescription } from '@/components/ui/card';
    import { Button } from '@/components/ui/button';
    import { ArrowRight, BookOpen } from 'lucide-react';

    const blogPosts = [
      {
        title: "The Future of Web: Headless CMS & SPAs",
        date: "2025-05-20",
        snippet: "Exploring how Single Page Applications combined with Headless CMS are revolutionizing content delivery and user experience...",
        imagePlaceholder: "Futuristic web interface concept",
        category: "Web Development",
        readMoreLink: "#" 
      },
      {
        title: "AI in Data Analytics: Trends to Watch in 2025",
        date: "2025-05-15",
        snippet: "Artificial Intelligence is no longer just a buzzword. Discover the key AI trends shaping data analytics and business intelligence...",
        imagePlaceholder: "Abstract data visualization with AI elements",
        category: "Data Science",
        readMoreLink: "#"
      },
      {
        title: "Maximizing SEO with Structured Data & Semantic HTML",
        date: "2025-05-10",
        snippet: "Dive deep into how proper HTML structure and schema markup can significantly boost your website's SEO performance...",
        imagePlaceholder: "Code snippet showing structured data",
        category: "SEO",
        readMoreLink: "#"
      },
    ];
    
    const cardVariants = {
      hidden: { opacity: 0, y: 50 },
      visible: (i) => ({
        opacity: 1,
        y: 0,
        transition: {
          delay: i * 0.15,
          duration: 0.6,
          ease: 'easeOut',
        },
      }),
    };

    const BlogPreview = () => {
      return (
        <section id="blog-preview" className="py-20 md:py-28 bg-gray-800/30">
          <div className="container mx-auto px-4 sm:px-6 lg:px-8">
            <motion.div
              initial={{ opacity: 0, y: -20 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true, amount: 0.3 }}
              transition={{ duration: 0.7, ease: 'easeOut' }}
              className="text-center mb-16"
            >
              <h2 className="text-3xl sm:text-4xl lg:text-5xl font-bold mb-4 flex items-center justify-center">
                <BookOpen className="h-10 w-10 text-primary mr-3" />
                <span className="text-transparent bg-clip-text bg-gradient-to-r from-primary via-accent to-green-400">Insights & Latest Tech</span>
              </h2>
              <p className="text-lg text-gray-300 max-w-2xl mx-auto">
                Stay updated with the latest trends, tips, and insights from the world of web development and data analytics.
              </p>
            </motion.div>

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
              {blogPosts.map((post, index) => (
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
                  <Card className="h-full flex flex-col glassmorphism border-primary/20 hover:border-primary transition-all duration-300 transform hover:shadow-xl hover:shadow-primary/15 overflow-hidden">
                    <CardHeader>
                      <div className="aspect-video bg-gray-700 rounded-md mb-4 flex items-center justify-center">
                        <img  
                          alt={post.title} 
                          className="object-cover w-full h-full text-gray-400"
                         src="https://images.unsplash.com/photo-1694388001616-1176f534d72f" />
                      </div>
                      <CardTitle className="text-xl font-semibold text-gray-100 hover:text-primary transition-colors">
                        <a href={post.readMoreLink}>{post.title}</a>
                      </CardTitle>
                      <CardDescription className="text-xs text-gray-400">
                        {post.date} &bull; <span className="text-accent">{post.category}</span>
                      </CardDescription>
                    </CardHeader>
                    <CardContent className="flex-grow">
                      <p className="text-gray-300 text-sm leading-relaxed">{post.snippet}</p>
                    </CardContent>
                    <CardFooter className="mt-auto pt-4 border-t border-gray-700/50">
                      <Button variant="link" className="text-primary p-0 h-auto hover:text-accent group" asChild>
                        <a href={post.readMoreLink}>
                          Read More <ArrowRight className="ml-2 h-4 w-4 group-hover:translate-x-1 transition-transform" />
                        </a>
                      </Button>
                    </CardFooter>
                  </Card>
                </motion.custom>
              ))}
            </div>
             <motion.div 
                className="text-center mt-12"
                initial={{opacity: 0}}
                whileInView={{opacity: 1}}
                viewport={{once: true}}
                transition={{delay: 0.5, duration: 0.5}}
            >
                <Button variant="outline" size="lg" className="group border-primary text-primary hover:bg-primary hover:text-primary-foreground transition-all duration-300 transform hover:scale-105 shadow-lg">
                    Visit Our Blog (Coming Soon)
                </Button>
            </motion.div>
          </div>
        </section>
      );
    };
    export default BlogPreview;