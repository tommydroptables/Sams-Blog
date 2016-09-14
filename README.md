# Sams-Blog
content Management System for Sam's Blog

# File Structure

All blog will go in the blog directory in the bellow order

```
blogs
   |
    --> Blog1
    	   |
    	   --> images
    	            |
    	            --> image1.pn
    	            --> image2.jpeg
    	            --> image3.gif
    	   --> Blog1-name.txt
    --> Blog2
            |
           ....
```

Note: all blogs must be text files (.txt) that follow the bello
order

# Format
Bellow is the format that the Blog1-name.txt files shoud be in. <b> Note:
\<IMAGE-NAME> needs to include the type of the image e.g. ```test.jpg```</b>

<b>NOTE: Leave 1 blank line between each paragraph in the  article section</b>

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

## Example Blog
```
:title: Lorem Ipsum

:summary:1.jpg:  0 Dessert cake cheesecake lollipop. Chupa chups wafer croissant chupa chups jujubes tootsie roll. Sweet gingerbread gummies danish carrot cake cotton candy wafer1 Dessert cake cheesecake lollipop. Chupa chups wafer croissant chupa chups jujubes tootsie roll. Sweet gingerbread gummies danish carrot cake cotton candy wafer.

:article:1.jpg: Dessert cake cheesecake lollipop. Chupa chups wafer croissant chupa chups jujubes tootsie roll. Sweet gingerbread gummies danish carrot cake cotton candy wafer.Dessert cake cheesecake lollipop. Chupa chups wafer croissant chupa chups jujubes tootsie roll. Sweet gingerbread gummies danish carrot cake cotton candy wafer.Dessert cake cheesecake lollipop. Chupa chups wafer croissant chupa chups jujubes tootsie roll. Sweet gingerbread gummies danish carrot cake cotton candy wafer.Dessert cake cheesecake lollipop. Chupa chups wafer croissant chupa chups jujubes tootsie roll. Sweet gingerbread gummies danish carrot cake cotton candy wafer.

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ac dolor fermentum, mollis arcu eget,
congue felis. Pellentesque vestibulum iaculis elementum. Pellentesque eu erat at magna fermentum
consequat vel sit amet quam. Cras imperdiet tortor rhoncus augue viverra, et laoreet leo imperdiet.
Curabitur eget faucibus orci. Vestibulum pulvinar magna sed sem lacinia pretium quis sed quam. Nunc
quis ultricies eros.

:image-left:1.jpg:
Quisque commodo efficitur ante, nec fringilla ex ornare vitae. Nulla mollis ligula sed tristique
semper. Maecenas sit amet mi vehicula, ornare lectus eget, scelerisque orci. Morbi sem nibh, suscipit
nec ante vitae, imperdiet viverra erat. Proin gravida eget nisi sit amet ullamcorper. Mauris turpis
massa, semper auctor quam non, porta lobortis mi. Praesent commodo nulla odio, at egestas mi dignissim
quis. Aenean volutpat augue in lacus porttitor bibendum. Cras dapibus luctus sem non luctus. Cras
:image-right:1.jpg:volutpat porta erat sed fringilla. Praesent tincidunt elit eu nunc faucibus, ut mattis quam commodo.
Vestibulum consequat neque non faucibus aliquet. Integer at metus et elit aliquet convallis. Vivamus
euismod risus massa, quis efficitur est tempor vel. Nam dolor nisl, vestibulum sed convallis quis,
cursus ac metus. Donec ac aliquet turpis.

Nulla suscipit mauris lacinia augue sollicitudin, quis tincidunt neque facilisis. Mauris in neque sit
amet nulla vulputate porttitor. Vivamus iaculis turpis odio, ac dictum augue condimentum a. Nullam
mollis vel nunc vitae dapibus. Sed efficitur nisi non nunc laoreet facilisis. Suspendisse sagittis,
ex eget sagittis varius, metus erat consectetur magna, ut tincidunt enim orci sit amet magna. Nullam
ligula lorem, placerat vel blandit et, pellentesque vitae ligula. Aenean blandit facilisis cursus.
Aenean sed porta mi. Proin vitae ante scelerisque, tincidunt eros eu, rutrum purus. Nullam sodales,
dolor vitae aliquet blandit, purus tortor malesuada lacus, eu pulvinar lectus nisi eu sem.

Sed a posuere erat. Mauris ac libero libero. Nulla eget ante eu sem scelerisque vehicula. Pellentesque
malesuada est eget metus lobortis fermentum. Pellentesque sit amet sem nec purus auctor porttitor.
Praesent erat ante, hendrerit id imperdiet ut, volutpat at ante. Cras vitae ornare augue. In vel
tincidunt odio. Vivamus sit amet risus lectus. Pellentesque nec nunc vel sem sollicitudin rutrum.
Praesent placerat velit a leo lacinia ultrices. In neque risus, mattis et nulla id, tempor lobortis
lorem. Sed sodales lectus at urna convallis vulputate. Curabitur malesuada consectetur mauris, sit
amet viverra est vehicula eu.

:image-full:1.jpg:
Cras nec tortor nisl. Fusce a nulla sed magna pharetra tempor id quis ipsum. Sed mattis, orci sit amet
luctus maximus, mi libero fringilla purus, quis hendrerit dui nisi vel dolor. Donec ac nibh in ante rutrum
tristique. Cras non viverra sapien, quis hendrerit risus. Donec sit amet lectus odio. Sed tellus ante,
feugiat a sapien ut, aliquam hendrerit tellus. Mauris vel libero elementum, aliquet lectus sit amet,
venenatis tortor. Duis vitae scelerisque dui. Mauris feugiat nulla sed augue vulputate lacinia. In sit
amet mauris vitae dolor consectetur varius. Curabitur mollis, justo eu ullamcorper hendrerit, nisl purus
pulvinar odio, id posuere sapien mi nec lectus. Interdum et malesuada fames ac ante ipsum primis in faucibus.
Ut finibus risus at euismod dictum. Quisque venenatis, dolor ut blandit dictum, odio est vestibulum dui,
vitae luctus lectus ex vel est.
```
