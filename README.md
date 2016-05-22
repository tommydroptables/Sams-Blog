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
    	   --> Blog1-name.txt
    --> Blog2
            |
           ....
```

Note: all blogs must be text files (.txt) that follow the bellow
order

# Format
Bellow is the format that the Blog1-name.txt files shoud be in. <b> Note:
\<IMAGE-NAME> needs to include the type of the image e.g. ```test.jpg```</b>

```
:title: best title ever
:summary:<IMAGE-NAME>: short summary of why the article. This will be show 'onHover' on the home page
The image specifed here will be shown in the cards on the home page.
:article:<IMAGE-NAME>: full artile. 
The image specifed here will be shown on the article page at the top.

NOTE: The elements below are part of the article
:image-left:<IMAGE-NAME>:
This is a smaller image that will be part of the artcile on the left side of the page
:image-right:<IMAGE-NAME>:
This is a smaller image that will be part of the artcile on the left side of the page
:image-full:<IMAGE-NAME>:
This is a larger image that will be part of the artcile that will be full width of the page
```
