#!/usr/bin/env bash

echo "PUSHING BLOG CHANGES"

cd /var/www/thanks-pearl.us/Sams-Blog/blogs

git commit -a -m "updating blogs"

# Push up to master

# The username and password are in a file in this format <USERNAME>:<PASSWORD>
username_password=$(cat /etc/thanks-pearl/git_info.conf)

git push https://${username_password}@bitbucket.org/cocoztho000/sams-blog-blogs.git master
