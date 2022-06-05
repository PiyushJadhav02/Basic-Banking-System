function OnSubNav(){
    let a = document.getElementById('sub');
    let empty=document.getElementById("e");
    

    if(a.style.display == 'flex')
    {
        a.style.display = 'none';
        empty.style.height="80px";
        
    }else{
        empty.style.height="275px";
        a.style.display = 'flex';
    }
}