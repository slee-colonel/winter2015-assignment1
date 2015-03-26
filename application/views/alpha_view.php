<!-- View people sorted by first-name-last-name alphabetical order -->
<div class="row container-fluid" style="width: 100%">
    {peoplelist}
    <a href="/alphabetical/articles/{who}" class="span2 btn" style="width: 93%">
        <figure style="float: left">
            <img src="/data/{mug}" title="{who}" style="float: left"
                 width="100" height="100"/>
        </figure>
        <div style="text-align:left">
            <h2>{who}</h2>
            <h4>Total Court Fees Owed: ${totalowed}</h4>
            <h4>Number Of News Articles: {numofarticles}</h4>
        </div>
    </a> 
    {/peoplelist}
</div>