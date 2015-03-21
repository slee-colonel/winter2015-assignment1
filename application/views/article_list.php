<div class="row container-fluid" style="width: 100%">
    <figure style="float: left">
        <img src="/data/{mug}" title="{who}" style="float: left"
             width="200" height="200"/>
    </figure>
    <h4>Articles About</h4>
    <h2 class="text-left">{who}</h2>
    <h4>{sortedby}</h4>
</div>

<div class="row container-fluid" style="width: 100%">
    {articlelist}
    <a href="/viewer/article/{id}" class="span2 btn" style="width: 93%">
        <div>
            <h4>{title}</h4>
            <h5>Court Costs: ${owed}</h5>
        </div>
    </a> 
    {/articlelist}    
</div>