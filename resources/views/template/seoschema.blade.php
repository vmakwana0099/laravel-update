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
    "lowPrice": "45",
    "highPrice": "3585"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.3",
    "ratingCount": "1000"
  }
}
</script>';
}
if(isset($CatId) && !empty($CatId)){ 
    //echo "cat id". $CatId;
    if($CatId == 1 || $CatId == 9){
    //Domain Registration - https://www.hostitsmart.com/domain
    //Domain Registration - https://www.hostitsmart.com/domain-registration
    /*echo '<script type="application/ld+json">
		{
		  "@context": "http://schema.org/",
		  "@type": "Product",
		  "name": "Domain Registration",
		  "image": "https://d1neo0gtmjcot5.cloudfront.net/assets/images/logo.png",
		  "description": "Buy cheap domain names with us. Host IT Smart India`s Leading Domain Registration & Web hosting Company. 24/7 Phone & Chat Support",
		  "sku": "Domain Registration",
  	      "mpn": "Domain Registration",
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
			"reviewCount": "395"
		  },
		 "offers": {
			"@type": "AggregateOffer",
			"priceCurrency": "INR",
			"lowprice": "349",
        	"highprice": "650",
       		"offercount": "4",								
			"seller": {
			 
		 }}
		}
	</script>';*/
  }
   else if($CatId == 10){
    //Web hosting - https://www.hostitsmart.com/web-hosting
    echo '<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "Web Hosting",
  "image": "https://d1neo0gtmjcot5.cloudfront.net/assets/images/logo.png",
  "description": "Get cheap web hosting plans in India start at Rs.45 per month and include a free SSL certificate, 99% uptime, 24*7 support, and a 30-day money-back guarantee.",
  "brand": {
    "@type": "Brand",
    "name": "Host IT Smart"
  },
  "offers": {
    "@type": "AggregateOffer",
    "url": "https://www.hostitsmart.com/web-hosting",
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
  "description": "Cheap Linux Web Hosting Services in India at Rs 45/month. We offer Linux Shared Hosting with cPanel. Get Free SSL, 99.9% uptime &amp; 30-day money-back guarantee.",
  "brand": {
    "@type": "Brand",
    "name": "Host IT Smart"
  },
  "offers": {
    "@type": "AggregateOffer",
    "url": "https://www.hostitsmart.com/hosting/linux-hosting",
    "priceCurrency": "INR",
    "lowPrice": "45",
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
    "lowPrice": "45",
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
  "description": "Begin an online store with the cheapest eCommerce hosting provider in India. Get the Best eCommerce website hosting Plans Ever! Starting at just Rs.45/mo.",
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
    "lowPrice": "45",
    "highPrice": "399"
  }
}
</script>';
  }
  // else if($ProductId == 13){
    //Java Hosting Page - https://www.hostitsmart.com/hosting/java-hosting
  //   echo '<script type="application/ld+json">
	// 	{
	// 	  "@context": "http://schema.org/",
	// 	  "@type": "Product",
	// 	  "name": "Java Hosting",
	// 	  "image": "https://d1neo0gtmjcot5.cloudfront.net/assets/images/logo.png",
	// 	  "description": "Host IT Smart is one of the best Java Hosting Server Provider In India. Our Java Hosting plans starting at Rs.80/month with 24/7 Technical Support.",
	// 	  "sku": "Java Hosting",
  // 	      "mpn": "Java Hosting",
	//       "brand": {
	// 	"@type": "Brand",
	// 	"name": "Host IT Smart"
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
	// 	  "aggregateRating": {
	// 		"@type": "AggregateRating",
	// 		"ratingValue": "4.4",
	// 		"reviewCount": "297"
	// 	  },
	// 	 "offers": {
	// 		"@type": "AggregateOffer",
	// 		"priceCurrency": "INR",
	// 		"lowprice": "80",
  //       	"highprice": "320",
  //      		"offercount": "4",								
	// 		"seller": {
	// 		  "@type": "Product",
	// 		  "name": "Java Hosting"
	// 	 }}
	// 	}
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
  "image": "https://d1neo0gtmjcot5.cloudfront.net/assets/images/logo.png",
  "description": "Host IT Smart offers cheap Windows VPS hosting server with 24X7 customer support at only Rs.1040/month. Free instant setup and flexible payment options.",
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
    "ratingValue": "4.5",
    "ratingCount": "1500"
  }
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