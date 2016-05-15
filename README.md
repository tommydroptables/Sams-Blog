# Sams-Blog
Content Management System for Sam's Blog

# File Structure

All blogs will go in the blog directory in the bellow order

```
blogs
   |
    --> Blog1
    	   |
    	   --> images
    	            |
    	            --> image1.png
    	            --> image2.jpeg
    	            --> image3.gif
    	   --> Blog1.txt
    --> Blog2
            |
           ....
```

Note: all blogs must be text files (.txt) that follow the bellow
order

# Format
Bellow is the format that the blog-name.txt files shoud be in.

```
:title: best title ever
:summary:IMAGE-NAME: short summary of why this is the best article ever made.
The image specifed here will be shown on the home page.
:article: full artile on why this is the best article. 
:image-title:IMAGE-NAME: will be a full screen image when you move to the page
When you have 2 spaces it will count as a paragraph break.

:image-left:IMAGE-NAME: Will split the image towards the left
half of the page
:image-right:IMAGE-NAME: Will split the image towards the right
half of the page
:image-full:IMAGE-NAME: Will allow the image to take up the full
with of the page.
```
