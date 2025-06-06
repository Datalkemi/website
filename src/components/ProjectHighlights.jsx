import React from 'react';
    import { motion } from 'framer-motion';
    import { Card, CardContent, CardFooter, CardHeader, CardTitle, CardDescription } from '@/components/ui/card';
    import { Button } from '@/components/ui/button';
    import { ExternalLink, Eye } from 'lucide-react';

    const projects = [
      {
        title: "E-commerce Platform Redesign",
        category: "Web Development & UI/UX",
        description: "Revamped a major online retailer's platform, focusing on user experience, performance, and mobile responsiveness. Implemented a modern tech stack for scalability.",
        imagePlaceholder: "Abstract e-commerce interface",
        tech: ["React", "Node.js", "TailwindCSS", "Stripe"],
        liveLink: "#", 
        caseStudyLink: "#"
      },
      {
        title: "Sales Analytics Dashboard",
        category: "Data Analytics & BI",
        description: "Developed an interactive dashboard for a B2B company to track sales KPIs, identify trends, and optimize their sales funnel. Provided actionable insights for decision-making.",
        imagePlaceholder: "Clean and modern data dashboard",
        tech: ["Power BI", "Python", "SQL", "AWS S3"],
        liveLink: "#",
        caseStudyLink: "#"
      },
      {
        title: "Startup MVP Launch",
        category: "Full-Stack Development",
        description: "Built and launched a Minimum Viable Product for a tech startup, including user authentication, core features, and a scalable cloud infrastructure.",
        imagePlaceholder: "App screenshot on a phone",
        tech: ["Next.js", "Supabase", "Vercel", "Figma"],
        liveLink: "#",
        caseStudyLink: "#"
      },
    ];

    const cardVariants = {
      hidden: { opacity: 0, y: 50, scale: 0.95 },
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

    const ProjectHighlights = () => {
      return (
        <section id="projects" className="py-20 md:py-28 bg-gray-800/50">
          <div className="container mx-auto px-4 sm:px-6 lg:px-8">
            <motion.div
              initial={{ opacity: 0, y: -20 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true, amount: 0.3 }}
              transition={{ duration: 0.7, ease: 'easeOut' }}
              className="text-center mb-16"
            >
              <h2 className="text-3xl sm:text-4xl lg:text-5xl font-bold mb-4">
                <span className="text-transparent bg-clip-text bg-gradient-to-r from-primary via-accent to-green-400">Project Highlights</span>
              </h2>
              <p className="text-lg text-gray-300 max-w-2xl mx-auto">
                A glimpse into some of the impactful solutions we've delivered for our clients.
              </p>
            </motion.div>

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
              {projects.map((project, index) => (
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
                  <Card className="h-full flex flex-col glassmorphism border-primary/20 hover:border-primary transition-all duration-300 transform hover:shadow-2xl hover:shadow-primary/20 overflow-hidden">
                    <CardHeader>
                      <div className="aspect-video bg-gray-700 rounded-md mb-4 flex items-center justify-center">
                        <img  
                          alt={project.title} 
                          className="object-cover w-full h-full text-gray-400"
                         src="https://images.unsplash.com/photo-1701330415878-163aacb005ff" />
                      </div>
                      <CardTitle className="text-xl font-semibold text-gray-100">{project.title}</CardTitle>
                      <CardDescription className="text-sm text-primary">{project.category}</CardDescription>
                    </CardHeader>
                    <CardContent className="flex-grow">
                      <p className="text-gray-300 text-sm leading-relaxed mb-3">{project.description}</p>
                      <div className="flex flex-wrap gap-2 mb-3">
                        {project.tech.map(t => <span key={t} className="text-xs bg-gray-700 text-accent px-2 py-1 rounded-full">{t}</span>)}
                      </div>
                    </CardContent>
                    <CardFooter className="mt-auto pt-4 border-t border-gray-700/50">
                      <div className="flex justify-between w-full gap-2">
                        <Button variant="outline" size="sm" className="text-primary border-primary hover:bg-primary hover:text-primary-foreground" asChild>
                          <a href={project.liveLink} target="_blank" rel="noopener noreferrer">
                            <Eye className="mr-2 h-4 w-4" /> View Live (Placeholder)
                          </a>
                        </Button>
                        <Button variant="ghost" size="sm" className="text-gray-300 hover:text-primary" asChild>
                          <a href={project.caseStudyLink} target="_blank" rel="noopener noreferrer">
                            Case Study <ExternalLink className="ml-2 h-4 w-4" />
                          </a>
                        </Button>
                      </div>
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
                <Button size="lg" variant="default" className="group bg-gradient-to-r from-primary to-accent hover:from-accent hover:to-primary transition-all duration-300 transform hover:scale-105 shadow-lg" asChild>
                    <a href="#contact">Discuss Your Project</a>
                </Button>
            </motion.div>
          </div>
        </section>
      );
    };

    export default ProjectHighlights;