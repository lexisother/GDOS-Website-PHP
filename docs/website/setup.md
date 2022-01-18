# GDOS-Website-PHP Setup Instructions

Welcome, welcome, to my infamous setup instruction document for the
`GDOS-Website-PHP` project!

I'll be guiding you through setting up everything you need to get the project
up and running.

Without further ado, let us start right away.

## What are we using?

To start off, here's a list of the things we'll be using for this guide, so
I won't need to keep specifyinig.

```txt
System:
  OS: Raspbian GNU/Linux 11 (bullseye)
  CPU: CPU: BCM2711 (4) @ 1.500GHz
  Shell: zsh 5.8
Packages:
  git (1:2.30.2-1)
  nginx (1.18.0-6.1)
  default-mysql-server (1.0.7)
  php-curl (2:7.4+76)
  php-fpm (2:7.4+76)
  php-mbstring (2:7.4+76)
  php-mysql (2:7.4+76)
  php-xml (2:7.4+76)
  php-zip (2:7.4+76)
Programs:
  Composer (2.1.12)
```

Things like the shell aren't important, of course, but the installed packages
and programs are crucial!

## Dependencies

To start off, let's install all dependencies.

Firstly, update your package repositories by running `sudo apt update`.

Then, install all the required packages by running `sudo apt update <the names of all packges here>`.

Next, we should install Composer. In the case that this guide goes out-of-date
due to Composer releasing a new version, head to
<https://getcomposer.org/download> for the installation instructions.

Finally, we should install Node.JS. Run the following command to get the Node
Version Manager set up: `curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.0/install.sh | bash`

After installation is complete, reload your shell, and run `nvm install node`
to install Node.JS.

Lastly, we need to set up a database for the website to write to. Assuming you
installed `default-mysql-server`, you can run the `mysql_secure_installation`
command to set up the database. I won't cover this part, because the script
guides you through installation.

That should be all to get you set up.

## Setting up the website

To get started, clone the repository to a local directory by using `git clone https://github.com/lexisother/GDOS-Website-PHP`.

Make sure to change your current directory to the newly created one by using
`cd GDOS-Website-PHP`.

Now, we need to install the website dependencies. We can do this by running
`composer update && npm install`.

Next, we need to configure the website. Run `cp .env.example .env` to copy the
example file to an actual config file.

Edit this file to suit your needs. Make sure the `DB_` values are set
correctly. No need to worry about anything else, as nothing else is actually
being used.

Next, run `php artisan migrate` to create all the required tables in the
database. To check if everything completed successfully, fire up your DB viewer
of choice and check out the database tables.

An SQL query like the following should suffice if you're using the command
line: <!-- see: https://stackoverflow.com/a/3914051 -->

```sql
SELECT TABLE_NAME
FROM INFORMATION_SCHEMA.TABLES
WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA = 'dbName'
```

The website uses a CSS preprocessor called "SASS", files of which have to be
built. Run `npm run dev` to build the CSS.

To make sure the website can access files saved to the `storage`
directory, run `php artisan storage:link` to create a symlink in the `public`
folder that points to the `storage` directory.

Now, finally, the website writes profile pictures to that `storage` folder. Normally, the
account running the web server (`www-data`) does not have permission to write
to any folders in your home directory.

To fix this, we simply run `sudo chmod -R o+w {public,storage}`. To explain,
`chmod` is a tool for changing the _mode bits_ of a file. The mode bits are the
deciding factor for what a file is. For example, a file with the `+x` bits is
an executable. `o+w` stands for `others+write`, which means other users can
write to whichever file or directory with these bits. Long story short, this
command allows the `www-data` user to write to our `public` and `storage`
directory.

### Web server

To set up nginx correctly, we'll have to make some changes to the `/etc/nginx/sites-enabled/default` file. You can delete it, and recreate it.

You can add the below block to the config. I have added some comments to help explain what everything does.

```nginx
# The `server` directive sets configuration for a virtual server.
server {
  # We listen on port 80.
  listen 80;
  listen [::]:80;

  # Our server name needn't be set, for it is implied. (`localhost`)
  server_name _;

  # The path to wherever your website files are.
  root /path/to/GDOS-Website-PHP/public;

  # We set the response header `X-Frame-Option` to one of the two available
  # directives, namely `SAMEORIGIN`. # This means the page can only be displayed
  # in a frame on the same origin as the page itself. (so it doesn't allow
  # embedding the page in other websites)
  add_header X-Frame-Options "SAMEORIGIN";

  # The `nosniff` option for X-Content-Type-Options blocks a request if the
  # request destination is of type `style` and the MIME type is not `text/css`,
  # or of type `script` and the MIME type is not a JavaScript MIME type.
  add_header X-Content-Type-Options "nosniff";

  # We tell nginx the default file it should display is `index.php`.
  index index.php;

  # The `charset` directive adds the specified charset to the `Content-Type`
  # response header field. If this charset is different from the charset
  # specified in the source_charset directive, a conversion is performed.
  charset utf-8;

  # The `location` directive sets configuration depending on a request URI.
  # See: http://nginx.org/en/docs/http/ngx_http_core_module.html#location
  location / {
    # http://nginx.org/en/docs/http/ngx_http_core_module.html#try_files
    try_files $uri $uri/ /index.php?$query_string;
  }

  # Disable logging of access to the favicon and robots.txt, as these are very
  # commonly accessed
  location = /favicon.ico { access_log off; log_not_found off; }
  location = /robots.txt { access_log off; log_not_found off; }

  # Our error handler is built into the website's framework, make sure to set it
  # accordingly
  error_page 404 /server.php;

  # The `~` in a `location` block denotes anything to the right side of it is
  # what we refer to as a "regular expression".
  # Regular expressions are a sequence of characters that specify a search
  # pattern in text.
  # In this case, we match everything that ends in `.php`.
  location ~ \.php$ {
    # The rest of the directives in here are related to the program we use to
    # run our PHP, as it is not done by NGINX.
    # For more information, either read the NGINX documentation or Google
    # "fastcgi"
    fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
    fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
    include fastcgi_params;
    include snippets/fastcgi-php.conf;
  }

  # Deny access to all files that start with a dot.
  location ~ /\.(?!well-known).* {
    deny all;
  }
}
```

## Conclusion

This project is ridiculous, overly engineered (thanks Laravel), but at the same time, terribly amazing.
