import React from 'react';
    import { motion } from 'framer-motion';
    import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
    import { Zap, Layers, Database, BarChart3, Code, Palette, GitBranch, Cloud, Settings, Brain } from 'lucide-react';

    const techCategories = [
      {
        name: "Frontend",
        icon: <Palette className="h-8 w-8 text-primary mb-2" />,
        tools: ["React", "Vite", "Tailwind CSS", "Figma", "HTML5", "CSS3", "JavaScript (ES6+)"],
        color: "border-sky-500/50",
      },
      {
        name: "Backend",
        icon: <Code className="h-8 w-8 text-primary mb-2" />,
        tools: ["Node.js", "Python (Django/Flask)", "Express.js", "REST APIs", "GraphQL"],
        color: "border-emerald-500/50",
      },
      {
        name: "Databases",
        icon: <Database className="h-8 w-8 text-primary mb-2" />,
        tools: ["SQL (PostgreSQL, MySQL)", "NoSQL (MongoDB)", "Supabase", "Firebase"],
        color: "border-rose-500/50",
      },
      {
        name: "Data & BI",
        icon: <BarChart3 className="h-8 w-8 text-primary mb-2" />,
        tools: ["Power BI", "Tableau", "Pandas", "NumPy", "Scikit-learn", "Jupyter"],
        color: "border-amber-500/50",
      },
      {
        name: "DevOps & Cloud",
        icon: <Cloud className="h-8 w-8 text-primary mb-2" />,
        tools: ["AWS", "Docker", "Git & GitHub", "Netlify", "Vercel", "CI/CD"],
        color: "border-purple-500/50",
      },
      {
        name: "General Tools",
        icon: <Settings className="h-8 w-8 text-primary mb-2" />,
        tools: ["VS Code", "NPM/Yarn", "ESLint", "Prettier", "Jira", "Slack"],
        color: "border-indigo-500/50",
      },
    ];

    const sectionVariants = {
      hidden: { opacity: 0 },
      visible: { 
        opacity: 1,
        transition: { staggerChildren: 0.1, delayChildren: 0.1 }
      }
    };

    const itemVariants = {
      hidden: { opacity: 0, y: 20 },
      visible: { opacity: 1, y: 0, transition: { duration: 0.5, ease: "easeOut" } }
    };

    const TechStack = () => {
      return (
        <section id="tech-stack" className="py-20 md:py-28 bg-gray-900/70 backdrop-blur-sm">
          <div className="container mx-auto px-4 sm:px-6 lg:px-8">
            <motion.div
              initial="hidden"
              whileInView="visible"
              viewport={{ once: true, amount: 0.2 }}
              variants={sectionVariants}
            >
              <motion.div variants={itemVariants} className="text-center mb-16">
                <h2 className="text-3xl sm:text-4xl lg:text-5xl font-bold mb-4">
                  <span className="text-transparent bg-clip-text bg-gradient-to-r from-primary via-accent to-green-400">Our Technology Stack</span>
                </h2>
                <p className="text-lg text-gray-300 max-w-2xl mx-auto">
                  We leverage a modern and robust set of tools and technologies to deliver high-quality solutions.
                </p>
              </motion.div>

              <motion.div 
                variants={sectionVariants}
                className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
              >
                {techCategories.map((category, index) => (
                  <motion.div key={index} variants={itemVariants}>
                    <Card className={`h-full glassmorphism border-t-4 ${category.color} hover:shadow-xl hover:shadow-primary/10 transition-all duration-300`}>
                      <CardHeader className="items-center text-center">
                        {category.icon}
                        <CardTitle className="text-2xl font-semibold text-gray-100">{category.name}</CardTitle>
                      </CardHeader>
                      <CardContent>
                        <ul className="space-y-2 text-center">
                          {category.tools.map((tool, toolIndex) => (
                            <motion.li 
                              key={toolIndex} 
                              className="text-gray-300 hover:text-primary transition-colors"
                              initial={{ opacity: 0, x: -10 }}
                              whileInView={{ opacity: 1, x: 0 }}
                              viewport={{ once: true }}
                              transition={{ delay: 0.1 * toolIndex, duration: 0.3}}
                            >
                              {tool}
                            </motion.li>
                          ))}
                        </ul>
                      </CardContent>
                    </Card>
                  </motion.div>
                ))}
              </motion.div>
            </motion.div>
          </div>
        </section>
      );
    };

    export default TechStack;