<?php 
if(empty(Request::segment(1))){
 //Home page    
  echo '<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Host IT Smart",
  "url": "https://www.hostitsmart.com",
  "logo": "https://d1neo0gtmjcot5.cloudfront.net/assets/images/logo.png",
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "07935079700",
    "contactType": "sales",
    "contactOption": "TollFree",
    "areaServed": "IN",
    "availableLanguage": ["en","Hindi"]
  },
  "sameAs": [
    "https://www.facebook.com/hostitsmart/",
    "https://twitter.com/HostITSmart",
    "https://www.instagram.com/hostitsmart/",
    "https://www.youtube.com/@HostITSmart",
    "https://www.linkedin.com/company/host-it-smart",
    "https://in.pinterest.com/hostitsmart/"
  ]
}
</script><script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "Web Hosting",
  "image": "https://d1neo0gtmjcot5.cloudfront.net/assets/images/logo.png",
  "description": "Get reliable & high-performance hosting services tailored to fuel your success from Host IT Smart for a seamless journey to online prosperity.",
  "brand": {
    "@type": "Brand",
    "name": "Host IT Smart"
  },
  "offers": {
    "@type": "AggregateOffer",
    "url": "https://www.hostitsmart.com",
    "priceCurrency": "INR",
    "lowPrice": "49",
    "highPrice": "399"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.3",
    "ratingCount": "1000"
  }
}
</script>';
}
if(Request::segment(1) == "domain-registration"){
 //Domain registration page    
  echo '<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "Domain Registration India",
  "image": "https://www.hostitsmart.com/assets/images/domain_registration/domain-ext-busi.webp",
  "description": "Looking to register a domain without breaking the bank? Our cheap domain registration service in India offers your perfect name at unbeatable prices.",
  "brand": {
    "@type": "Brand",
    "name": "Host IT Smart"
  },
  "offers": {
    "@type": "AggregateOffer",
    "url": "https://www.hostitsmart.com/domain-registration",
    "priceCurrency": "INR",
    "lowPrice": "643.28",
    "highPrice": "2204.96",
    "offerCount": "200"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.5",
    "bestRating": "5",
    "worstRating": "1",
    "ratingCount": "1500"
  }
}
</script>';
}
if(Request::segment(2) == "java-hosting"){
 //Domain registration page    
  echo '<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "Java Hosting",
  "image": "https://www.hostitsmart.com/assets/images/java_hosting/java-hosting-banner.webp",
  "description": "Host IT Smart is one of the best Java Hosting Server Provider In India. Our Java Hosting plans starting at 420/month with 24/7 Technical Support.",
  "brand": {
    "@type": "Brand",
    "name": "Host IT Smart"
  },
  "offers": {
    "@type": "AggregateOffer",
    "url": "https://www.hostitsmart.com/servers/java-hosting",
    "priceCurrency": "INR",
    "lowPrice": "420",
    "highPrice": "1675",
    "offerCount": "4"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.5",
    "bestRating": "5",
    "worstRating": "1",
    "ratingCount": "1500"
  },
  "review": [{
    "@type": "Review",
    "name": "Harish Nokhwaal",
    "reviewBody": "I\'ve had a great experience with this hosting company! Their service is fast, reliable, and affordable. My website runs smoothly with zero downtime, and their customer support is always quick to help and very professional. Highly recommended for anyone looking for a solid hosting provider!",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "5",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "2025-06-16",
    "author": {"@type": "Person", "name": "Harish Nokhwaal"},
    "publisher": {"@type": "Organization", "name": "Host IT Smart"}
  },{
    "@type": "Review",
    "name": "Anshu Bhardwaj",
    "reviewBody": "I purchased a VPS server there. Everything seems fine so far. After the purchase, there were some errors with the VPS, but they fixed them. They even assisted me via call and AnyDesk. I really love their support.",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "5",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "2025-06-16",
    "author": {"@type": "Person", "name": "Anshu Bhardwaj"},
    "publisher": {"@type": "Organization", "name": "Host IT Smart"}
  },{
    "@type": "Review",
    "name": "Rizwan Raja",
    "reviewBody": "One of the best and cheap hosting in India, I have been using their services for the last 5 years and have never faced any problem. If you need a hosting solution, HOSTITSMART is the best in their services. Their support team is awesome. They will help in going far better in their fields, and all are very supportive.",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "5",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "2025-06-16",
    "author": {"@type": "Person", "name": "Rizwan Raja"},
    "publisher": {"@type": "Organization", "name": "Host IT Smart"}
  },{
    "@type": "Review",
    "name": "Nikhil Jain",
    "reviewBody": "I was searching for a good company for my domain name and Java web hosting after my previous company got bankrupt. Luckily I found Host IT Smart. And all the things have again came at their right places at a very good price. Thanks, Host IT Smart Team & Jackob Sir.",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "5",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "2025-06-16",
    "author": {"@type": "Person", "name": "Nikhil Jain"},
    "publisher": {"@type": "Organization", "name": "Host IT Smart"}
  },{
    "@type": "Review",
    "name": "s2 TECH INDIA",
    "reviewBody": "Exceptional help center! Quick and effective solutions provided with a friendly and knowledgeable team. They made my experience smooth and hassle-free. Definitely my go-to for assistance.",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "5",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "2025-06-16",
    "author": {"@type": "Person", "name": "s2 TECH INDIA"},
    "publisher": {"@type": "Organization", "name": "Host IT Smart"}
  },{
    "@type": "Review",
    "name": "Urvashi Shrivastava",
    "reviewBody": "One of the best service providers. Extremely satisfied with their customer service and cost effectiveness. Using their services for quite a long and have never faced any delays in taking action against issues. Thanks much!!",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "5",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "2025-06-16",
    "author": {"@type": "Person", "name": "Urvashi Shrivastava"},
    "publisher": {"@type": "Organization", "name": "Host IT Smart"}
  },{
    "@type": "Review",
    "name": "Divyanshu Agarwal",
    "reviewBody": "I have been using their services quite a lot for the last 6 months. I like the ease of use they provided while working with VPS. Also, In case of any issues, the resolution is quite fast.",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "5",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "2025-06-16",
    "author": {"@type": "Person", "name": "Divyanshu Agarwal"},
    "publisher": {"@type": "Organization", "name": "Host IT Smart"}
  },{
    "@type": "Review",
    "name": "Nirmal Paradkar",
    "reviewBody": "Very cooperative and very helpful person is Your employee, Mr. Mohan. He always behaves very nicely and is well-mannered. Solves all my problems quickly and has a good rapport with customers. He is also a technically sound person.",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "5",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "2025-06-16",
    "author": {"@type": "Person", "name": "Nirmal Paradkar"},
    "publisher": {"@type": "Organization", "name": "Host IT Smart"}
  },{
    "@type": "Review",
    "name": "Nilesh Mourya",
    "reviewBody": "Dealing with Happy Service’s customer support was a breeze. They were courteous, quick to respond, and resolved my issue efficiently, leaving me with a positive impression of their commitment to customer satisfaction.",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "5",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "2025-06-16",
    "author": {"@type": "Person", "name": "Nilesh Mourya"},
    "publisher": {"@type": "Organization", "name": "Host IT Smart"}
  },{
    "@type": "Review",
    "name": "Selvakumar Baskaran",
    "reviewBody": "The host Support team is easy to reach. Appreciate their efficiency of reaching out to them within seconds. Keep it up, guys. Mohsin was a smart guy to provide resolutions quickly.",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "5",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "2025-06-16",
    "author": {"@type": "Person", "name": "Selvakumar Baskaran"},
    "publisher": {"@type": "Organization", "name": "Host IT Smart"}
  },{
    "@type": "Review",
    "name": "Bhavesh Tarkhala",
    "reviewBody": "I have been using servers from Host IT Smart since the last 3 years and I recommend the service of Host IT Smart. They were quick to respond to any queries or concerns. Service and support are awesome!!",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "5",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "2025-06-16",
    "author": {"@type": "Person", "name": "Bhavesh Tarkhala"},
    "publisher": {"@type": "Organization", "name": "Host IT Smart"}
  },{
    "@type": "Review",
    "name": "Patel Rushil",
    "reviewBody": "I\'ve been using Host IT Smart for over 2 years now, and I couldn\'t be happier! The server performance is fantastic, with almost no downtime, and the loading speeds are incredible. But what stands out the most is their customer support. Anytime I’ve had an issue, their team has been quick to respond and extremely helpful. Highly recommend it for anyone looking for reliable and top-notch hosting!",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "5",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "2025-06-16",
    "author": {"@type": "Person", "name": "Patel Rushil"},
    "publisher": {"@type": "Organization", "name": "Host IT Smart"}
  },{
    "@type": "Review",
    "name": "Ramdas Tambe",
    "reviewBody": "I am very happy to be a customer of host it smart from a reputed company. Especially the immediate service was made available. We hope to continue to provide the same service....Ramdas Tambe Reporter today news channel.",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "5",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "2025-06-16",
    "author": {"@type": "Person", "name": "Ramdas Tambe"},
    "publisher": {"@type": "Organization", "name": "Host IT Smart"}
  },{
    "@type": "Review",
    "name": "Axone Infotech",
    "reviewBody": "We have experienced exceptional server support and performance with this service. The team is highly responsive, professional, and always available to address any concerns or issues we encounter. Overall, we are highly satisfied with both the support and the server\'s performance.",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "5",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "2025-06-16",
    "author": {"@type": "Person", "name": "Axone Infotech"},
    "publisher": {"@type": "Organization", "name": "Host IT Smart"}
  },{
    "@type": "Review",
    "name": "Vasudev Doddipalle",
    "reviewBody": "Jay Vagadiya was very helpful and quickly resolved one of the issues faced.. We have made the right moving to hostitsmart. Helpdesk, Sales and technical support teams are very easy to approach for help when needed.",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "5",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "2025-06-16",
    "author": {"@type": "Person", "name": "Vasudev Doddipalle"},
    "publisher": {"@type": "Organization", "name": "Host IT Smart"}
  },{
    "@type": "Review",
    "name": "Chandni Gupta",
    "reviewBody": "Great Service!! I\'ve been using a Hosting service from Host IT Smart from the last few years. They provide a great service. You can reach them anytime for help or with queries. Their service is recommended. I didn\'t face any major issues while using their hosting plan. Everything works smoothly. Great service.",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "5",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "2025-06-16",
    "author": {"@type": "Person", "name": "Chandni Gupta"},
    "publisher": {"@type": "Organization", "name": "Host IT Smart"}
  },{
    "@type": "Review",
    "name": "Milan Parmar",
    "reviewBody": "I have purchased a dedicated server of 32 GB RAM. And I am very much satisfied with the service. Mr Jay is very helpful and supportive. I recommend to all of you who are willing to buy their service.",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "5",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "2025-06-16",
    "author": {"@type": "Person", "name": "Milan Parmar"},
    "publisher": {"@type": "Organization", "name": "Host IT Smart"}
  }]
}
</script>
 ';
}
if(isset($CatId) && !empty($CatId)){ 
    if($CatId == 1 || $CatId == 9){
    
  }
   else if($CatId == 10){
    //Web hosting - https://www.hostitsmart.com/web-hosting
    echo '<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "Web Hosting",
  "image": "https://d1neo0gtmjcot5.cloudfront.net/assets/images/logo.png",
  "description": "Get cheap web hosting plans in India start at Rs.49 per month and include a free SSL certificate, 99% uptime, 24*7 support, and a 30-day money-back guarantee.",
  "brand": {
    "@type": "Brand",
    "name": "Host IT Smart"
  },
  "offers": {
    "@type": "AggregateOffer",
    "url": "https://www.hostitsmart.com/web-hosting",
    "priceCurrency": "INR",
    "lowPrice": "49",
    "highPrice": "399"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.3",
    "bestRating": "5",
    "worstRating": "1",
    "ratingCount": "1000"
  }
}
</script>';
  }
  else if($CatId == 11){
    //Web hosting ahmedabad- https://www.hostitsmart.com/web-hosting-ahmedabad
    echo '<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "Web Hosting Ahmedabad",
  "image": "https://d1neo0gtmjcot5.cloudfront.net/assets/images/logo.png",
  "description": "Get affordable and reliable web hosting services in Ahmedabad. Our budget-friendly plans offer top-notch performance and 24/7 support. Get started today!",
  "brand": {
    "@type": "Brand",
    "name": "Host IT Smart"
  },
  "offers": {
    "@type": "AggregateOffer",
    "url": "https://www.hostitsmart.com/web-hosting-ahmedabad",
    "priceCurrency": "INR",
    "lowPrice": "45",
    "highPrice": "399"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.3",
    "bestRating": "5",
    "worstRating": "1",
    "ratingCount": "1000"
  }
}
</script>';
  }
   else if($CatId == 4){
    //SSL Certificate - https://www.hostitsmart.com/ssl
    echo '<script type="application/ld+json">
    {
      "@context": "http://schema.org/",
      "@type": "Product",
      "name": "SSL Certificate",
      "image": "https://d1neo0gtmjcot5.cloudfront.net/assets/images/logo.png",
      "description": "Host IT Smart is one of the best SSL Certificate providers in India. Buy SSL certificates for your website in only Rs.60/ Month with Free Trust Logo from Comodo, GeoTrust, and Thawte.",
      "sku": "SSL Certificate",
          "mpn": "SSL Certificate",
        "brand": {
    "@type": "Brand",
    "name": "Host IT Smart"
    },
       "review": {
    "@type": "Review",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "4.5",
      "bestRating": "5"
    },
    "author": {
      "@type": "Organization",
      "name": "Host IT Smart"
    }
    },
      "aggregateRating": {
      "@type": "AggregateRating",
      "ratingValue": "4.5",
      "reviewCount": "286"
      },
     "offers": {
      "@type": "AggregateOffer",
      "priceCurrency": "INR",
      "lowprice": "720",
          "highprice": "7200",
          "offercount": "4",                
      "seller": {
       
     }}
    }
  </script>';
  }
}
  if(isset($ProductId) && !empty($ProductId)){ 
  //echo "Pro Id: ".$ProductId;
  if($ProductId == 1){
    //Linux Hosting Page - https://www.hostitsmart.com/hosting/linux-hosting
    echo '<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "Linux Hosting",
  "image": "https://d1neo0gtmjcot5.cloudfront.net/assets/images/logo.png",
  "description": "Cheap Linux Web Hosting Services in India at Rs 49/month. We offer Linux Shared Hosting with cPanel. Get Free SSL, 99.9% uptime &amp; 30-day money-back guarantee.",
  "brand": {
    "@type": "Brand",
    "name": "Host IT Smart"
  },
  "offers": {
    "@type": "AggregateOffer",
    "url": "https://www.hostitsmart.com/hosting/linux-hosting",
    "priceCurrency": "INR",
    "lowPrice": "49",
    "highPrice": "399"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.5",
    "ratingCount": "1500"
  }
}
</script>';
  }
  else if($ProductId == 2){ 
  //Windows Hosting Page - https://www.hostitsmart.com/hosting/windows-hosting
    echo '';
  }
  else if($ProductId == 4){
    //WordPress Hosting Page - https://www.hostitsmart.com/hosting/wordpress-hosting
    echo '<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "WordPress Hosting",
  "image": "https://www.hostitsmart.com/assets/images/logo.webp",
  "description": "Get Cheap WordPress Hosting in India with 80% OFF, offering blazing-fast speed, 99.9% uptime, and 24/7 expert support. Start your WordPress site today!",
  "brand": {
    "@type": "Brand",
    "name": "Host IT Smart"
  },
  "offers": {
    "@type": "AggregateOffer",
    "url": "https://www.hostitsmart.com/hosting/wordpress-hosting",
    "priceCurrency": "INR",
    "lowPrice": "49",
    "highPrice": "399"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.3",
    "ratingCount": "1000"
  }
}
</script>';
  }
  else if($ProductId == 6){
    //eCommerce Page - https://www.hostitsmart.com/hosting/ecommerce-hosting
    echo '<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "eCommerce Hosting",
  "image": "https://d1neo0gtmjcot5.cloudfront.net/assets/images/logo.png",
  "description": "Begin an online store with the cheapest eCommerce hosting provider in India. Get the Best eCommerce website hosting Plans Ever! Starting at just Rs.49/mo.",
  "brand": {
    "@type": "Brand",
    "name": "Host IT Smart"
  },
  "sku": "eCommerce Hosting",
  "mpn": "eCommerce Hosting",
  "offers": {
    "@type": "AggregateOffer",
    "url": "https://www.hostitsmart.com/hosting/ecommerce-hosting",
    "priceCurrency": "INR",
    "lowPrice": "49",
    "highPrice": "399"
  }
}
</script>';
  }
  // else if($ProductId == 13){
    //Java Hosting Page - https://www.hostitsmart.com/hosting/java-hosting
  //   echo '<script type="application/ld+json">
  //  {
  //    "@context": "http://schema.org/",
  //    "@type": "Product",
  //    "name": "Java Hosting",
  //    "image": "https://d1neo0gtmjcot5.cloudfront.net/assets/images/logo.png",
  //    "description": "Host IT Smart is one of the best Java Hosting Server Provider In India. Our Java Hosting plans starting at Rs.80/month with 24/7 Technical Support.",
  //    "sku": "Java Hosting",
  //        "mpn": "Java Hosting",
  //       "brand": {
  //  "@type": "Brand",
  //  "name": "Host IT Smart"
  //   },
  //      "review": {
  //   "@type": "Review",
  //   "reviewRating": {
  //     "@type": "Rating",
  //     "ratingValue": "4.4",
  //     "bestRating": "5"
  //   },
  //   "author": {
  //     "@type": "Organization",
  //     "name": "Host IT Smart"
  //   }
  //   },
  //    "aggregateRating": {
  //    "@type": "AggregateRating",
  //    "ratingValue": "4.4",
  //    "reviewCount": "297"
  //    },
  //   "offers": {
  //    "@type": "AggregateOffer",
  //    "priceCurrency": "INR",
  //    "lowprice": "80",
  //        "highprice": "320",
  //          "offercount": "4",                
  //    "seller": {
  //      "@type": "Product",
  //      "name": "Java Hosting"
  //   }}
  //  }
  // </script>';
    
  // }
  else if($ProductId == 15){
    //Linux Reseller Hosting - https://www.hostitsmart.com/hosting/linux-reseller-hosting
    echo '<script type="application/ld+json">
    {
      "@context": "http://schema.org/",
      "@type": "Product",
      "name": "Linux Reseller Hosting",
      "image": "https://d1neo0gtmjcot5.cloudfront.net/assets/images/logo.png",
      "description": "Are you looking for the cheapest Linux Reseller Hosting provider in India? Host IT Smart offers Best Reseller Hosting plan with unlimited websites. Start your hosting business only for Rs.1100/Month.",
      "sku": "Linux Reseller Hosting",
          "mpn": "Linux Reseller Hosting",
        "brand": {
    "@type": "Brand",
    "name": "Host IT Smart"
    },
       "review": {
    "@type": "Review",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "4.7",
      "bestRating": "5"
    },
    "author": {
      "@type": "Organization",
      "name": "Host IT Smart"
    }
    },
      "aggregateRating": {
      "@type": "AggregateRating",
      "ratingValue": "4.7",
      "reviewCount": "298"
      },
     "offers": {
      "@type": "AggregateOffer",
      "priceCurrency": "INR",
      "lowprice": "2500",
          "highprice": "4500",
          "offercount": "4",                
      "seller": {
        
     }}
    }
  </script>';
    
  }
  else if($ProductId == 16){
    //Bulk Domain - https://www.hostitsmart.com/domain/bulk-domain-search
    echo '';
  }
  else if($ProductId == 12){
    //Windows Reseller Hosting - https://www.hostitsmart.com/hosting/windows-reseller-hosting
    echo '<script type="application/ld+json">
    {
      "@context": "http://schema.org/",
      "@type": "Product",
      "name": "Windows Reseller Hosting",
      "image": "https://d1neo0gtmjcot5.cloudfront.net/assets/images/logo.png",
      "description": "Choose your Windows Reseller hosting Plans at Host IT Smart. Get Unlimited Bandwidth, Website, Email or Subdomain in Business Plan. Starting Rs.1500/month.",
      "sku": "Windows Reseller Hosting",
          "mpn": "Windows Reseller Hosting",
        "brand": {
    "@type": "Brand",
    "name": "Host IT Smart"
    },
       "review": {
    "@type": "Review",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "4.8",
      "bestRating": "5"
    },
    "author": {
      "@type": "Organization",
      "name": "Host IT Smart"
    }
    },
      "aggregateRating": {
      "@type": "AggregateRating",
      "ratingValue": "4.8",
      "reviewCount": "321"
      },
     "offers": {
      "@type": "AggregateOffer",
      "priceCurrency": "INR",
      "lowprice": "1500",
          "highprice": "2500",
          "offercount": "4",                
      "seller": {
        
     }}
    }
  </script>';
  }
  else if($ProductId == 7){
    //VPS Hosting - https://www.hostitsmart.com/servers/vps-hosting
    echo '<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "VPS Hosting",
  "image": "https://d1neo0gtmjcot5.cloudfront.net/assets/images/logo.png",
  "description": "Get world-class performance and reliability with India’s cheapest VPS Hosting services & Elevate your online presence. Explore our plans & packages!",
  "brand": {
    "@type": "Brand",
    "name": "Host IT Smart"
  },
  "offers": {
    "@type": "AggregateOffer",
    "url": "https://www.hostitsmart.com/servers/vps-hosting",
    "priceCurrency": "INR",
    "lowPrice": "420",
    "highPrice": "1675"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.5",
    "bestRating": "5",
    "worstRating": "1",
    "ratingCount": "1500"
  }
}
</script>';
  }
  else if($ProductId == 32){
    //VPS Hosting - https://www.hostitsmart.com/servers/vps-hosting-india
    echo '<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "VPS Hosting India",
  "image": "https://www.hostitsmart.com/assets/images/vps_hosting/VPS-hosting-india.webp",
  "description": "Get reliable VPS Hosting in India with full root access, scalable plans, and an affordable VPS server price, which is perfect for developers and businesses.",
  "brand": {
    "@type": "Brand",
    "name": "Host IT Smart"
  },
  "offers": {
    "@type": "AggregateOffer",
    "url": "https://www.hostitsmart.com/servers/vps-hosting-india",
    "priceCurrency": "INR",
    "lowPrice": "420",
    "highPrice": "1675"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.5",
    "bestRating": "5",
    "worstRating": "1",
    "ratingCount": "1500"
  }
}
</script>';
  }
  else if($ProductId == 8){
    //Dedicated Server - https://www.hostitsmart.com/servers/dedicated-servers
    echo '<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "Dedicated Server",
  "image": "https://d1neo0gtmjcot5.cloudfront.net/assets/images/logo.png",
  "description": "Cheapest Dedicated Server Hosting provider in India with affordable price with Windows & Linux Dedicated Hosting. Get a Dedicated Server for only ₹3585/Month.",
  "brand": {
    "@type": "Brand",
    "name": "Host IT Smart"
  },
  "sku": "Dedicated Server",
  "mpn": "Dedicated Server",
  "offers": {
    "@type": "AggregateOffer",
    "url": "https://www.hostitsmart.com/servers/dedicated-servers",
    "priceCurrency": "INR",
    "lowPrice": "5202",
    "highPrice": "9945"
  }
}
</script>';
    
  }
   else if($ProductId == 14){
    //Domain Transfer - https://www.hostitsmart.com/domain/domain-transfer
    echo '<script type="application/ld+json">
    {
      "@context": "http://schema.org/",
      "@type": "Product",
      "name": "Domain Registration",
      "image": "https://d1neo0gtmjcot5.cloudfront.net/assets/images/logo.png",
      "description": "Are you looking to domain transfer & renewal? Host IT Smart one of the best place for you where you can transfer your registered domain with us in cheap rate.",
      "sku": "Domain Transfer",
          "mpn": "Domain Transfer",
        "brand": {
    "@type": "Brand",
    "name": "Host IT Smart"
    },
       "review": {
    "@type": "Review",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "4.9",
      "bestRating": "5"
    },
    "author": {
      "@type": "Organization",
      "name": "Host IT Smart"
    }
    },
      "aggregateRating": {
      "@type": "AggregateRating",
      "ratingValue": "4.9",
      "reviewCount": "427"
      }
     
    }
  </script>';
    
  }
     else if($ProductId == 20){
    //Sitelock - https://www.hostitsmart.com/hosting/site-lock
    echo '<script type="application/ld+json">
    {
      "@context": "http://schema.org/",
      "@type": "Product",
      "name": "SiteLock",
      "image": "https://d1neo0gtmjcot5.cloudfront.net/assets/images/logo.png",
      "description": "Get High Security & Malware Protection for your website. Host IT Smart offers site lock only Rs. 125/mo with daily blacklist monitoring.",
      "sku": "SiteLock",
          "mpn": "SiteLock",
        "brand": {
    "@type": "Brand",
    "name": "Host IT Smart"
    },
       "review": {
    "@type": "Review",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "4.4",
      "bestRating": "5"
    },
    "author": {
      "@type": "Organization",
      "name": "Host IT Smart"
    }
    },
      "aggregateRating": {
      "@type": "AggregateRating",
      "ratingValue": "4.4",
      "reviewCount": "297"
      },
     "offers": {
      "@type": "AggregateOffer",
      "priceCurrency": "INR",
      "lowprice": "125",
          "highprice": "1598",
          "offercount": "4",                
      "seller": {
       
     }}
    }
  </script>';
    
  }
  else if($ProductId == 21){
    //Google apps - https://www.hostitsmart.com/email/google-apps
    echo '<script type="application/ld+json">
    {
      "@context": "http://schema.org/",
      "@type": "Product",
      "name": "Google Apps",
      "image": "https://d1neo0gtmjcot5.cloudfront.net/assets/images/logo.png",
      "description": "Host IT Smart offers Google Apps for work. Access your Work from Anywhere, So manage your work and store your data online.",
      "sku": "Google Apps",
          "mpn": "Google Apps",
        "brand": {
    "@type": "Brand",
    "name": "Host IT Smart"
    },
       "review": {
    "@type": "Review",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "4.3",
      "bestRating": "5"
    },
    "author": {
      "@type": "Organization",
      "name": "Host IT Smart"
    }
    },
      "aggregateRating": {
      "@type": "AggregateRating",
      "ratingValue": "4.3",
      "reviewCount": "263"
      },
     "offers": {
      "@type": "AggregateOffer",
      "priceCurrency": "INR",
      "lowprice": "150",
          "highprice": "1520",
          "offercount": "4",                
      "seller": {
        
     }}
    }
  </script>';
    
  }
  else if($ProductId == 22){
    //Office 365 - https://global.hostitsmart.com/email/microsoft-office-365-suite
    echo '';
  }
  else if($ProductId == 23){
      //https://www.hostitsmart.com/servers/linux-vps-hosting
      echo '<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "Linux VPS Hosting",
  "image": "https://d1neo0gtmjcot5.cloudfront.net/assets/images/logo.png",
  "description": "Explore powerful & secured Linux VPS hosting solutions tailored to the enterprise needs for their strong online presence. Get upto 50% OFF on plans.",
  "brand": {
    "@type": "Brand",
    "name": "Host IT Smart"
  },
  "offers": {
    "@type": "AggregateOffer",
    "url": "https://www.hostitsmart.com/servers/linux-vps-hosting",
    "priceCurrency": "INR",
    "lowPrice": "420",
    "highPrice": "1675"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.3",
    "bestRating": "5",
    "worstRating": "1",
    "ratingCount": "1000"
  }
}
</script>';
  }
  else if($ProductId == 24){
      //https://www.hostitsmart.com/servers/windows-vps-hosting
      echo '<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "Product", 
  "name": "Windows VPS Hosting",
  "image": "https://www.hostitsmart.com/assets/images/windows_vps_hosting/win-vps-bnnr.svg",
  "description": "Host IT Smart offers pocket friendly Windows VPS hosting server in India at only ₹825/month based on KVM Virtualization.",
  "brand": {
    "@type": "Brand",
    "name": "Host IT Smart"
  },
  "offers": {
    "@type": "AggregateOffer",
    "url": "https://www.hostitsmart.com/servers/windows-vps-hosting",
    "priceCurrency": "INR",
    "lowPrice": "825",
    "highPrice": "5190"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "5",
    "bestRating": "5",
    "worstRating": "1",
    "ratingCount": "1500",
    "reviewCount": "1500"
  },
  "review": [{
    "@type": "Review",
    "name": "Harish Nokhwaal",
    "reviewBody": "I\'ve had a great experience with this hosting company! Their service is fast, reliable, and affordable. My website runs smoothly with zero downtime, and their customer support is always quick to help and very professional. Highly recommended for anyone looking for a solid hosting provider!",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "5",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "2025-06-16",
    "author": {"@type": "Person", "name": ""},
    "publisher": {"@type": "Organization", "name": "Host IT Smart"}
  },{
    "@type": "Review",
    "name": "Anshu Bhardwaj",
    "reviewBody": "I purchased a VPS server there. Everything seems fine so far. After the purchase, there were some errors with the VPS, but they fixed them. They even assisted me via call and AnyDesk. I really love their support.",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "5",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "2025-06-16",
    "author": {"@type": "Person", "name": ""},
    "publisher": {"@type": "Organization", "name": "Host IT Smart"}
  },{
    "@type": "Review",
    "name": "Rizwan Raja",
    "reviewBody": "One of the best and cheap hosting in India, I have been using their services for the last 5 years and have never faced any problem. If you need a hosting solution, HOSTITSMART is the best in their services. Their support team is awesome. They will help in going far better in their fields, and all are very supportive.",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "5",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "2025-06-16",
    "author": {"@type": "Person", "name": ""},
    "publisher": {"@type": "Organization", "name": "Host IT Smart"}
  },{
    "@type": "Review",
    "name": "Nikhil Jain",
    "reviewBody": "I was searching for a good company for my domain name and Java web hosting after my previous company got bankrupt. Luckily I found Host IT Smart. And all the things have again came at their right places at a very good price. Thanks, Host IT Smart Team & Jackob Sir.",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "5",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "2025-06-16",
    "author": {"@type": "Person", "name": ""},
    "publisher": {"@type": "Organization", "name": "Host IT Smart"}
  },{
    "@type": "Review",
    "name": "s2 TECH INDIA",
    "reviewBody": "Exceptional help center! Quick and effective solutions provided with a friendly and knowledgeable team. They made my experience smooth and hassle-free. Definitely my go-to for assistance.",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "5",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "2025-06-16",
    "author": {"@type": "Person", "name": ""},
    "publisher": {"@type": "Organization", "name": "Host IT Smart"}
  },{
    "@type": "Review",
    "name": "Urvashi Shrivastava",
    "reviewBody": "One of the best service providers. Extremely satisfied with their customer service and cost effectiveness. Using their services for quite a long and have never faced any delays in taking action against issues. Thanks much!!",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "5",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "2025-06-16",
    "author": {"@type": "Person", "name": ""},
    "publisher": {"@type": "Organization", "name": "Host IT Smart"}
  },{
    "@type": "Review",
    "name": "Divyanshu Agarwal",
    "reviewBody": "I have been using their services quite a lot for the last 6 months. I like the ease of use they provided while working with VPS. Also, In case of any issues, the resolution is quite fast.",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "5",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "2025-06-16",
    "author": {"@type": "Person", "name": ""},
    "publisher": {"@type": "Organization", "name": "Host IT Smart"}
  },{
    "@type": "Review",
    "name": "Nirmal Paradkar",
    "reviewBody": "Very cooperative and very helpful person is Your employee, Mr. Mohan. He always behaves very nicely and is well-mannered. Solves all my problems quickly and has a good rapport with customers. He is also a technically sound person.",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "5",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "2025-06-16",
    "author": {"@type": "Person", "name": ""},
    "publisher": {"@type": "Organization", "name": "Host IT Smart"}
  },{
    "@type": "Review",
    "name": "Nilesh Mourya",
    "reviewBody": "Dealing with Happy Service’s customer support was a breeze. They were courteous, quick to respond, and resolved my issue efficiently, leaving me with a positive impression of their commitment to customer satisfaction.",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "5",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "2025-06-16",
    "author": {"@type": "Person", "name": ""},
    "publisher": {"@type": "Organization", "name": "Host IT Smart"}
  },{
    "@type": "Review",
    "name": "Selvakumar Baskaran",
    "reviewBody": "The host Support team is easy to reach. Appreciate their efficiency of reaching out to them within seconds. Keep it up, guys. Mohsin was a smart guy to provide resolutions quickly.",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "5",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "2025-06-16",
    "author": {"@type": "Person", "name": ""},
    "publisher": {"@type": "Organization", "name": "Host IT Smart"}
  },{
    "@type": "Review",
    "name": "Bhavesh Tarkhala",
    "reviewBody": "I have been using servers from Host IT Smart since the last 3 years and I recommend the service of Host IT Smart. They were quick to respond to any queries or concerns. Service and support are awesome!!",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "5",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "2025-06-16",
    "author": {"@type": "Person", "name": ""},
    "publisher": {"@type": "Organization", "name": "Host IT Smart"}
  },{
    "@type": "Review",
    "name": "Patel Rushil",
    "reviewBody": "I\'ve been using Host IT Smart for over 2 years now, and I couldn\'t be happier! The server performance is fantastic, with almost no downtime, and the loading speeds are incredible. But what stands out the most is their customer support. Anytime I’ve had an issue, their team has been quick to respond and extremely helpful. Highly recommend it for anyone looking for reliable and top-notch hosting!",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "5",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "2025-06-16",
    "author": {"@type": "Person", "name": ""},
    "publisher": {"@type": "Organization", "name": "Host IT Smart"}
  },{
    "@type": "Review",
    "name": "Ramdas Tambe",
    "reviewBody": "I am very happy to be a customer of host it smart from a reputed company. Especially the immediate service was made available. We hope to continue to provide the same service....Ramdas Tambe Reporter today news channel.",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "5",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "2025-06-16",
    "author": {"@type": "Person", "name": ""},
    "publisher": {"@type": "Organization", "name": "Host IT Smart"}
  },{
    "@type": "Review",
    "name": "Axone Infotech",
    "reviewBody": "We have experienced exceptional server support and performance with this service. The team is highly responsive, professional, and always available to address any concerns or issues we encounter. Overall, we are highly satisfied with both the support and the server\'s performance.",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "5",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "2025-06-16",
    "author": {"@type": "Person", "name": ""},
    "publisher": {"@type": "Organization", "name": "Host IT Smart"}
  },{
    "@type": "Review",
    "name": "Vasudev Doddipalle",
    "reviewBody": "Jay Vagadiya was very helpful and quickly resolved one of the issues faced.. We have made the right moving to hostitsmart. Helpdesk, Sales and technical support teams are very easy to approach for help when needed.",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "5",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "2025-06-16",
    "author": {"@type": "Person", "name": ""},
    "publisher": {"@type": "Organization", "name": "Host IT Smart"}
  },{
    "@type": "Review",
    "name": "Chandni Gupta",
    "reviewBody": "Great Service!! I\'ve been using a Hosting service from Host IT Smart from the last few years. They provide a great service. You can reach them anytime for help or with queries. Their service is recommended. I didn\'t face any major issues while using their hosting plan. Everything works smoothly. Great service.",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "5",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "2025-06-16",
    "author": {"@type": "Person", "name": ""},
    "publisher": {"@type": "Organization", "name": "Host IT Smart"}
  },{
    "@type": "Review",
    "name": "Milan Parmar",
    "reviewBody": "I have purchased a dedicated server of 32 GB RAM. And I am very much satisfied with the service. Mr Jay is very helpful and supportive. I recommend to all of you who are willing to buy their service.",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "5",
      "bestRating": "5",
      "worstRating": "1"
    },
    "datePublished": "2025-06-16",
    "author": {"@type": "Person", "name": ""},
    "publisher": {"@type": "Organization", "name": "Host IT Smart"}
  }]
}
</script>';
  }
  else if($ProductId == 26){
      //https://www.hostitsmart.com/servers/forex-vps-hosting
      echo '<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "Forex VPS Hosting",
  "image": "https://d1neo0gtmjcot5.cloudfront.net/assets/images/logo.png",
  "description": "With Host IT Smart, Get the most reliable forex VPS hosting server offering you quick speed with minimum latency. India Datacenter. Check out our plans now!",
  "brand": {
    "@type": "Brand",
    "name": "Host IT Smart"
  },
  "offers": {
    "@type": "AggregateOffer",
    "url": "https://www.hostitsmart.com/servers/forex-vps-hosting",
    "priceCurrency": "INR",
    "lowPrice": "825",
    "highPrice": "2587.5"
  }
}
</script>';
  }
}