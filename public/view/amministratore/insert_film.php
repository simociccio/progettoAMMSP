<form action="" method="post" id='form'>
    
    <p>
    <label>
        <span>Titolo :</span>
        <input id="name" type="text" name="name"  />
    </label>
    </p>

    <p>
    <label>
        <span>Autore :</span>
        <input id="autore" type="autore" name="autore"  />
    </label>    </p> 
    

    <p>
    <label>
        <span>Prezzo :</span>
        <input id="prezzo" type="prezzo" name="prezzo" onkeyup="digits(this);" />
    </label>   </p> 
     
    <p>
    <label>
        <span>Durata :</span>
        <input id="durata" type="durata" name="durata" onkeyup="digits(this);" />
    </label>   </p>             
   
    <p>
    <label>
        <span>trama :</span>
        <textarea id="trama" name="trama" ></textarea>
    </label>   </p> 
    
    <p>
    <label id="button">
        <input type="button" class="button" value="Send" /> 
    </label>  
    </p>
</form>