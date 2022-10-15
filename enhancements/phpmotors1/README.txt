I. (Option 1) Run a local XAMPP server in docker.
    a. https://www.docker.com/products/docker-desktop/.

    b. Create a new folder called cse340, with an index.php file with the following content:

    <?php
        phpinfo();

    c. Create a phpmotors folder inside the cse340 folder at the same level as the index.php file.

    d. Open up your .zshrc and add the following aliases:

    alias runxampp='docker run --name cse340-xampp -p 8022:22 -p 8080:80 -p 3306:3306 -d -v ~/cse340:/www tomsik68/xampp:8'
    alias sshxampp='ssh root@localhost -p 8022'
    alias execxampp='docker exec -it cse340-xampp bash'
    alias stopxampp='docker stop cse340-xampp'
    alias startxampp='docker start cse340-xampp'
    alias rmxampp='docker stop cse340-xampp;docker container rm cse340-xampp'

    e. Source this file.

    `. ~/.zshrc`

    f. Run the container.

    `runxampp`

    g. Create a symlink to the phpmotors folder.

    `execxampp`
    `cd /opt/lampp/htdocs`
    `ln -s /www/phpmotors`
    `apt-get install mlocate`
    `updatedb`

    h. Go to http://localhost:8080 in your browser.

    i. Go to http://localhost:8080/phpmyadmin, to verify that MySQL is running.

II. (Option 2) Run local nginx/php/mysql server in docker containers.
    a. https://www.docker.com/products/docker-desktop/.
    b. Create a new folder called cse340 where your phpmotors folder will be housed.
    c. Create a new file called docker-compose.yml with the following content:

    version: "3.9"

    services:
      web:
        container_name: phpmotors
        image: nginx:latest
        ports:
          - "3000:80"
        volumes:
          - ./:/var/www/html
          - ./default.conf:/etc/nginx/conf.d/default.conf
        networks:
          - phpmotors

      php-fpm:
        container_name: phpmotors_fpm
        image: php:8-fpm
        volumes:
          - ./:/var/www/html
        networks:
          - phpmotors

      mysql:
        container_name: phpmotors_mysql
        platform: linux/x86_64
        image: mysql:latest
        environment:
          - MYSQL_ROOT_PASSWORD=root
          - MYSQL_DATABASE=phpmotors
          - MYSQL_USER=iClient
          - MYSQL_PASSWORD=cxw*bfy8dwc0amj9XZQ
        volumes:
          - ./db_data:/var/lib/mysql
        ports:
          - "3306:3306"
        networks:
          - phpmotors

    volumes:
      db_data:

    networks:
      phpmotors:

    d. Create a new file called default.conf with the following content:

    server {
        index index.php index.html;
        server_name phpmotors.local;
        error_log  /var/log/nginx/error.log;
        access_log /var/log/nginx/access.log;
        root /var/www/html;
        location ~ \.php$ {
            try_files $uri =404;
            fastcgi_split_path_info ^(.+\.php)(/.+)$;
            fastcgi_pass php-fpm:9000;
            fastcgi_index index.php;
            include fastcgi_params;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            fastcgi_param PATH_INFO $fastcgi_path_info;
        }
    }

    e. Bring up your docker containers in your CLI.

    `docker-compose up -d`

    f. Go to http://localhost:3000 in your browser.

    * `docker-compose down` will bring your containers down.

    g. Connect to the local MySQL docker container with the credentials from the docker-compose.yml file:

    MYSQL_DATABASE=phpmotors
    MYSQL_USER=iClient
    MYSQL_PASSWORD=cxw*bfy8dwc0amj9XZQ

III. (Option 3) Run a local PHP server.
    a. Create a new folder called cse340 where your phpmotors folder will be housed.
    b. Create a file called index.php with the following content:

    <?php
        phpinfo();

    c. In your CLI, go into this cse340 folder and run the following:

    `php -S 3000`

    d. Go to http://localhost:3000 in your browser.

IV. Build your template.
    a. Create a new file called template.php in the root of your phpmotors directory.
    b. Create a simple structure, like the following:

    <!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="UTF-8">
        <title>Content Title | PHP Motors</title>
      </head>
      <body>
        <div id="wrapper">
          <header>
            <div>
              <img src="/phpmotors/images/site/logo.png" alt="PHP Motors logo" id="logo">
              <a href="/phpmotors/accounts?action=login-page" title="Login or Register with PHP Motors" id="acc">My Account</a>
            </div>
          </header>
          <nav>
            <ul>
              <li><a href="/phpmotors/" title="PHP Motors home page">Home</a></li>
              <li><a href="#" title="clasic cars page">Classic</a></li>
              <li><a href="#" title="sports cars">Sports</a></li>
              <li><a href="#" title="sports utility vehicles">SUV</a></li>
              <li><a href="#" title="trucks">Trucks</a></li>
              <li><a href="#" title="used cars">Used</a></li>
            </ul>
          </nav>
          <main><h1>Content Title Here</h1></main>
          <hr>
          <footer>
            <p>&copy; PHP Motors, All rights reserved.</p>
            <p>Images are believed to be "Fair Use". Notify the author if not and they will be removed.</p>
            <p>Last Updated: <?php echo date('j F, Y',getlastmod());  ?></p>
          </footer>
        </div>
      </body>
    </html>

    c. Check http://localhost/phpmotors/template.php to verify that it comes up.
    d. Add the viewport meta element.

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    e. Create your style.css file and link to it in your template.php file, with a media = "screen" attribute.

    <link href="/phpmotors/css/style.css" type="text/css" rel="stylesheet" media="screen">

    f. Added a site-wide font to your styles.css.

    /********************************************************
    CSS Styles for phpmotors

    1. General styles
       1.0 @imports
       1.1 Header
       1.2 Navigation
       1.3 Body
       1.4 Footer
       1.5 Delorean
       1.6 @media
    ********************************************************/
    @import url('https://fonts.googleapis.com/css?family=Share+Tech+Mono&display=swap');

    /********************************************************
       1.3 body
    ********************************************************/
    body {
      font-family: 'Share Tech Mono', sans-serif;
      margin: 0;
    }

    g. Reload your template and make sure this font is applied (you should notice a huge difference).
    h. Validate your local HTML and CSS and WAVE accessibility.
    i. Put your header, nav and footer in their own php files, with the sample content and link them into the template.

    <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/header.php" ?>
    </header>

    <nav>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/nav.php" ?>
    </nav>

    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
    </footer>

    k. Add the header styles to make the header appear like the image in the enhancement.

    /********************************************************
       1.1 Header
    ********************************************************/
    header div {
      display: flex;
      justify-content: space-between;
      width: 95%;
    }

    header a {
      align-self: center;
      text-decoration: none;
      color: #3a3a3a;
      font-size: 1.2em;
    }

    h1,
    h2 {
      font-size: 1.2em;
    }

    l. Add the nav styles.

    /********************************************************
       1.2 Navigation
    ********************************************************/
    nav {
      background-color: #3a3a3a;
    }

    nav ul {
      display: flex;
      padding: 0 0 0 .25rem;
      justify-content: space-evenly;
      max-width: 100%;
    }

    nav a {
      color: white;
      text-decoration: none;
      font-size: 1em;
      padding-top: 1em;
      padding-bottom: 1em;
    }

    nav li {
      list-style: none;
      padding-top: 1em;
      padding-bottom: 1em;
    }

    /********************************************************
      1.6 @media section
    ********************************************************/
    @media only screen and (min-width: 768px) {
      nav {
        margin-top: .75rem;
      }

      nav ul {
        justify-content: flex-start;
        padding: 0;
        margin: 0;
      }

      nav li {
        margin: 0;
        font-size: 1.2em;
        padding: 0;
        text-align: center;
      }

      nav a {
        display: inline-block;
        width: 4.5em;
        padding: .25rem 0;
      }

      nav a:hover {
        color: #3a3a3a;
        background-color: #fff;
      }
    }

    m. Add the footer styles.

    /********************************************************
       1.4 footer
    ********************************************************/
    footer p {
      text-align: center;
      margin-top: 0;
      margin-bottom: 0;
      font-size: .9em;
    }

    hr {
      border: 2px solid #3a3a3a;
    }

    n. Add remaining styles for the template.

    #wrapper {
      width: 100%;
      background-color: white;
      margin-left: auto;
      margin-right: auto;
      padding-bottom: 1em;
    }

    main {
      padding-left: .25rem;
    }

    section {
      margin-bottom: 2em;
      margin-top: 1em;
    }

    section h2,
    h1 {
      margin-left: .25em;
    }

    // In the media section - this creates the outline of a box for the web page, surrounded by a checkered pattern
    body {
      background-image: url("/phpmotors/images/site/small_check.jpg");
      background-size: cover;
    }

    #wrapper {
      border: 5px solid #4c96d7;
      border-radius: 10px;
      margin-top: 1em;
      width: 75%;
    }

    h1 {
      font-size: 1.9em;
    }

    o. Check your CSS, HTML, WAVE and responsiveness for a sanity check.

V. Build your Home Page.
    a. Start by creating a home.php page and copying the template.php content into this page.
    b. Update the title of the page.

    <title>Home | PHP Motors</title>

    c. Add the Welcome to PHP Motors!

    <h1>Welcome to PHP Motors!</h1>

    d. Add the HTML for the DMC Delorean section.

    <section id="delorean">
      <ul>
        <li><h2>DMC Delorean</h2></li>
        <li>3 Cup holders</li>
        <li>Superman doors</li>
        <li>Fuzzy dice!</li>
        <li>
          <a href="/phpmotors/cart/" title="cart">
            <img id="actionbtn" alt="Add to cart button" src="/phpmotors/images/site/own_today.png">
          </a>
        </li>
      </ul>
    </section>

    e. Add the styles for the delorean section.

    /********************************************************
       1.5 Delorean section
    ********************************************************/
    #delorean {
      background-image: url("/phpmotors/images/delorean.jpg");
      background-repeat: no-repeat;
      background-size: contain;
      background-position-x: center;
      margin-left: auto;
      margin-right: auto;
      display: flex;
    }

    #delorean h2 {
      margin-left: 0;
    }

    #delorean a:hover {
      opacity: .5;
    }

    #delorean li {
      list-style: none;
      color: #4c96d7;

    }

    #delorean li h2 {
      margin-top: 0;
      margin-bottom: 0;
      color: #4c96d7;
    }

    #delorean ul {
      padding-left: 0;
      margin-top: 0;
      max-width: 200px;
      margin-left: .5em;
      margin-bottom: 8em;
      background-color: rgba(255, 255, 255, 0.7);
    }

    #delorean li {
      font-size: .85em;
    }

    #actionbtn {
      display: none;
    }

    #actionbtn:hover {
      opacity: .5;
    }

    // In the media section

    #delorean ul {
      font-size: 1.6em;
      margin-left: 2em;
      margin-top: 1em;
      margin-bottom: 15em;
    }

    #delorean {
      background-size: contain;
      margin-bottom: 0;
    }

    #actionbtn {
      display: block;
      width: 90%;
      margin-top: 1.5em;
    }

    f. Add HTML for the Delorean Upgrades and Reviews sections.

    <div class="flex-content">
              <section id="review">
                <h2>DMC Delorean Reviews</h2>
                <ul>
                  <li>"So fast its almost like traveling in time." (4/5)</li>
                  <li>"Coolest ride on the road." (4/5)</li>
                  <li>"I'm feeling McFly!" (5/5)</li>
                  <li>"The most futuristic ride of our day." (4.5/5)</li>
                  <li>"80's livin and I love it!" (5/5)</li>
                </ul>
              </section>
              <section id="add-ons">
                <h2>Delorean Upgrades</h2>
                <div class="flex">
                  <a href="#" title="flux-capacitor">
                    <figure>
                      <div class="add-col">
                        <img src="/phpmotors/images/upgrades/flux-cap.png" alt="Picture of a flux capacitor">
                      </div>
                      <figcaption>Flux Capacitor</figcaption>
                    </figure>
                  </a>
                  <a href="#" title="flame decals">
                    <figure>
                      <div class="add-col">
                        <img src="/phpmotors/images/upgrades/flame.jpg" alt="Picture of a flame decal">
                      </div>
                      <figcaption>Flame Decals</figcaption>
                    </figure>
                  </a>
                </div>
                <div class="flex">
                  <a href="#" title="bumper stickers">
                    <figure>
                      <div class="add-col">
                        <img src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="Picture of Bumper Stickers">
                      </div>
                      <figcaption>Bumper Stickers</figcaption>
                    </figure>
                  </a>
                  <a href="#" title="hub caps">
                    <figure>
                      <div class="add-col">
                        <img src="/phpmotors/images/upgrades/hub-cap.jpg" alt="Picture of Hub Caps">
                      </div>
                      <figcaption>Hub Caps</figcaption>
                    </figure>
                  </a>
                </div>
              </section>
            </div>

    g. Add CSS for these sections.

    .flex {
      display: flex;
      margin-bottom: 2em;
      justify-content: center;
      width: 100%;
      padding-left: .25em;

    }

    .flex a {
      width: 100%;
    }

    .add-col {
      background-color: #4c96d7;
      height: 5.5em;
      width: 95%;
      border: #3a3a3a solid 1px;
    }

    a figure {
      margin: 0;
    }

    figure img {
      display: block;
      margin: auto;
      padding-top: .5em;
    }

    figure figcaption {
      text-align: center;
    }

    #review li {
      font-size: .9em;
      margin-bottom: 1em;
    }

    // In the @media section

    .flex-content {
      display: flex;
      justify-content: space-around;
    }

    #review h2,
    #add-ons h2 {
      font-size: 1.4em;
      margin-bottom: 2em;
    }

    #add-ons {
      order: -1;
    }

    #review li {
      font-size: 1.1em;
    }

    #add-ons {
      width: 45%;
    }

    #add-ons, #review {
      margin-top: 0;
    }

  h. Validate your HTML, CSS, WAVE and responsiveness.
