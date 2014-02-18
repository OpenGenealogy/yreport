yreport
=======

#Report Y-DNA haplogroup and subclade

This project will contain programs to report on y-dna from multiple
providers, using multiple different y-trees.  It is currently 
almost empty.

##isoggy

isoggy.php is a proof of concept for spotting matching markers
in the ISOGG Y-DNA tree of haplogroups, and 23andme Y-chromosone data.

Initially, it loads the index.txt file derived by 
[isoggy](https://github.com/OpenGenealogy/isoggy) from
the ISOGG tree.

It then loads the 23andme Y-chrom data, which it expects to
find in a file called y.txt. (you need to provide your own, but I'll
add some public domain sample files later). 

The initial simple test is to match the deletes and inserts
between these, to see which markers are present in the 23andme data.

The results a printed, in subclade order, showing on each line
the subclade, Y-position, value, and SNP aliases.

Example:

    R1b1a2a1a	14641193  	T	PF6541/L52	
    R1b1a2a1a	16492547  	T	PF6542/L151	
    R1b1a2a1a	17844018  	C	S127/L11/PF6539	
    R1b1a2a1a	18248698  	G	S128/P311/PF6545	
    R1b1a2a1a	18907236  	C	S129/P310/PF6546  
    
This is a very basic check missing many features, it's just to
see if everything can be read in OK and there's some basic
sense in the results.

##Roadmap

This needs to be greatly enhanced, to show which markers
are present in the 23andme data (whether matching or not),
whether all the markers for a subclade are present, and so on.

Then, it needs to consider other Y-trees, there are many
currently available and due to be releases.  Imports for
each of these will need to be written.

Finally, this is for 23andme data.  It needs to allow for
other data formats, including genome.js.

##Feedback

I'd love to hear what could be added to this to
make it useful to you.  It's right at the beginning,
so all ideas are really helpful and welcome.

Please raise an issue, so
that it can be tracked.    

Rob Hoare
