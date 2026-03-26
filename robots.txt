# robots.txt for Antalya Korsan Taksi
# https://antalyakorsan.com/robots.txt

User-agent: *
Allow: /

# Sitemap
Sitemap: https://antalyakorsan.com/sitemap.php

# Disallow admin area
Disallow: /admin/
Disallow: /includes/
Disallow: /database/
Disallow: /uploads/temp/

# Disallow search results
Disallow: /search.php
Disallow: /*?s=
Disallow: /*&s=

# Disallow login/register pages
Disallow: /login.php
Disallow: /register.php
Disallow: /forgot-password.php

# Allow CSS and JS
Allow: /assets/css/
Allow: /assets/js/
Allow: /assets/images/

# Crawl-delay
Crawl-delay: 1

# Specific bots
User-agent: Googlebot
Allow: /
Crawl-delay: 0

User-agent: Googlebot-Image
Allow: /assets/images/

User-agent: Bingbot
Allow: /
Crawl-delay: 1

User-agent: Yandex
Allow: /
Crawl-delay: 2

# Bad bots
User-agent: AhrefsBot
Crawl-delay: 10

User-agent: SemrushBot
Crawl-delay: 10

User-agent: MJ12bot
Disallow: /

User-agent: DotBot
Disallow: /

# Social media bots
User-agent: facebookexternalhit
Allow: /

User-agent: Twitterbot
Allow: /

User-agent: WhatsApp
Allow: /

# Host
Host: https://antalyakorsan.com
