#!/usr/bin/env bash

# Script to update blogs every 2 hours
# Add this as a cron:
# 1) crontab -l
# 2) add this cron `0 */2 * * * ./var/www/thanks-pearl.us/Sams-Blog/tools/blog_cron_updater.sh`

echo "PUSHING BLOG CHANGES"

cd /var/www/thanks-pearl.us/Sams-Blog/blogs

git add .
git commit -a -m "updating blogs"

# Push up to master

# The username and password are in a file in this format <USERNAME>:<PASSWORD>
username_password=$(cat /etc/thanks-pearl/git_info.conf)

git push https://${username_password}@bitbucket.org/cocoztho000/sams-blog-blogs.git master
