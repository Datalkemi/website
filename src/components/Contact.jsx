import React, { useState } from "react";
import { motion } from "framer-motion";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Textarea } from "@/components/ui/textarea";
import { Label } from "@/components/ui/label";
import { useToast } from "@/components/ui/use-toast";
import { Send, Loader2, Mail, Linkedin, Github, Instagram } from "lucide-react";

const Contact = () => {
  const { toast } = useToast();
  const [formData, setFormData] = useState({
    name: "",
    email: "",
    message: "",
  });
  const [isLoading, setIsLoading] = useState(false);

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData((prev) => ({ ...prev, [name]: value }));
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setIsLoading(true);

    try {
      const response = await fetch("https://formspree.io/f/mvgajvyw", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          Accept: "application/json",
        },
        body: JSON.stringify(formData),
      });

      if (response.ok) {
        setFormData({ name: "", email: "", message: "" });
        toast({
          title: "Message Sent!",
          description:
            "Thank you for your query. We'll get back to you soon at info@datalkemi.com.",
          variant: "default",
          className: "bg-primary text-primary-foreground border-primary",
        });
      } else {
        throw new Error("Form submission failed.");
      }
    } catch (error) {
      toast({
        title: "Error",
        description: "Something went wrong. Please try again later.",
        variant: "destructive",
      });
    } finally {
      setIsLoading(false);
    }
  };

  const socialLinks = [
    {
      icon: <Linkedin className="h-6 w-6" />,
      href: "https://linkedin.com",
      label: "LinkedIn",
    },
    {
      icon: <Github className="h-6 w-6" />,
      href: "https://github.com",
      label: "GitHub",
    },
    {
      icon: <Instagram className="h-6 w-6" />,
      href: "https://instagram.com",
      label: "Instagram",
    },
  ];

  return (
    <section
      id="contact"
      className="py-20 md:py-28 bg-gradient-to-b from-gray-900 to-gray-800/70"
    >
      <div className="container mx-auto px-4 sm:px-6 lg:px-8">
        <motion.div
          initial={{ opacity: 0, y: -20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true, amount: 0.3 }}
          transition={{ duration: 0.7, ease: "easeOut" }}
          className="text-center mb-16"
        >
          <h2 className="text-3xl sm:text-4xl lg:text-5xl font-bold mb-4">
            <span className="text-transparent bg-clip-text bg-gradient-to-r from-primary via-accent to-green-400">
              Get in Touch
            </span>
          </h2>
          <p className="text-lg text-gray-300 max-w-xl mx-auto">
            Have a project idea or need expert advice? We're here to help you
            succeed. Reach out to us!
          </p>
        </motion.div>

        <div className="grid lg:grid-cols-5 gap-10 items-start">
          <motion.div
            className="lg:col-span-2 space-y-8"
            initial={{ opacity: 0, x: -30 }}
            whileInView={{ opacity: 1, x: 0 }}
            viewport={{ once: true, amount: 0.2 }}
            transition={{ duration: 0.7, ease: "easeOut" }}
          >
            <div className="p-6 glassmorphism rounded-xl">
              <h3 className="text-xl font-semibold text-primary mb-3 flex items-center">
                <Mail className="mr-2 h-5 w-5" />
                Email Us
              </h3>
              <a
                href="mailto:info@datalkemi.com"
                className="text-gray-200 hover:text-accent transition-colors"
              >
                info@datalkemi.com
              </a>
              <p className="text-sm text-gray-400 mt-1">
                We typically respond within 24 hours.
              </p>
            </div>

            <div className="p-6 glassmorphism rounded-xl">
              <h3 className="text-xl font-semibold text-primary mb-4">
                Connect With Us
              </h3>
              <div className="flex space-x-4">
                {socialLinks.map((link, index) => (
                  <motion.a
                    key={index}
                    href={link.href}
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label={link.label}
                    className="text-gray-300 hover:text-primary transition-colors p-2 bg-gray-700/50 rounded-full hover:bg-primary/20"
                    whileHover={{ scale: 1.1, y: -2 }}
                    transition={{ type: "spring", stiffness: 300 }}
                  >
                    {link.icon}
                  </motion.a>
                ))}
              </div>
            </div>
            <div className="p-6 glassmorphism rounded-xl">
              <h3 className="text-xl font-semibold text-primary mb-3">
                Office Location (Placeholder)
              </h3>
              <p className="text-gray-300">
                123 Tech Avenue, Innovation City, ST 54321
              </p>
              <div className="mt-4 h-48 bg-gray-700/50 rounded-md flex items-center justify-center text-gray-500">
                Embedded Map Placeholder
              </div>
            </div>
          </motion.div>

          <motion.div
            initial={{ opacity: 0, x: 30 }}
            whileInView={{ opacity: 1, x: 0 }}
            viewport={{ once: true, amount: 0.2 }}
            transition={{ duration: 0.7, delay: 0.2, ease: "easeOut" }}
            className="lg:col-span-3 p-8 md:p-10 glassmorphism rounded-xl shadow-2xl shadow-primary/10"
          >
            <form onSubmit={handleSubmit} className="space-y-6">
              <div>
                <Label htmlFor="name" className="text-gray-200 font-medium">
                  Full Name
                </Label>
                <Input
                  type="text"
                  id="name"
                  name="name"
                  value={formData.name}
                  onChange={handleChange}
                  placeholder="e.g. Jane Doe"
                  required
                  className="mt-2 bg-gray-700/50 border-gray-600 text-gray-100 placeholder-gray-400 focus:ring-primary focus:border-primary"
                />
              </div>
              <div>
                <Label htmlFor="email" className="text-gray-200 font-medium">
                  Email Address
                </Label>
                <Input
                  type="email"
                  id="email"
                  name="email"
                  value={formData.email}
                  onChange={handleChange}
                  placeholder="e.g. jane.doe@example.com"
                  required
                  className="mt-2 bg-gray-700/50 border-gray-600 text-gray-100 placeholder-gray-400 focus:ring-primary focus:border-primary"
                />
              </div>
              <div>
                <Label htmlFor="message" className="text-gray-200 font-medium">
                  Your Message
                </Label>
                <Textarea
                  id="message"
                  name="message"
                  value={formData.message}
                  onChange={handleChange}
                  placeholder="Tell us about your project, requirements, or any questions you have..."
                  rows={5}
                  required
                  className="mt-2 bg-gray-700/50 border-gray-600 text-gray-100 placeholder-gray-400 focus:ring-primary focus:border-primary"
                />
              </div>
              <div className="text-center pt-2">
                <Button
                  type="submit"
                  size="lg"
                  className="w-full sm:w-auto group bg-gradient-to-r from-primary to-accent hover:from-accent hover:to-primary transition-all duration-300 transform hover:scale-105 shadow-lg py-3 px-8"
                  disabled={isLoading}
                >
                  {isLoading ? (
                    <Loader2 className="mr-2 h-5 w-5 animate-spin" />
                  ) : (
                    <Send className="mr-2 h-5 w-5 group-hover:translate-x-1 transition-transform" />
                  )}
                  {isLoading ? "Sending..." : "Send Your Inquiry"}
                </Button>
              </div>
            </form>
          </motion.div>
        </div>
      </div>
    </section>
  );
};

export default Contact;
