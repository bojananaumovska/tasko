<x-app-layout>
    <style>
        *{
    margin: 0;
    padding: 0;
}

body{
    font-family: 'Open Sans';
}

#main{
    width: 90%;
    margin: auto;
}

#header{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 20px 0 20px 0;
    padding: 0 20px 0 20px;
}

#header .logo{
    display: flex;
    align-items: center;
}


#header .logo img{
    margin: 0 10px 0 0;
}

#header .logo a{
    text-decoration: none;
    color: #000000;
}

#header .nav ul{
    list-style: none;
    display: flex;
}

#header .nav ul li a{
    text-decoration: none;
    color: #000000;
    padding: 0 10px 0 10px;
    font-size: 24px;
}

#header .button{
    display: flex;
    align-items: center;
    /* background: url("./src/btn_background.png") no-repeat; */
    background: linear-gradient(to right, #fadeee, #F1808D);
    border: none;
    border-radius: 50px;
    padding: 5px 15px 5px 15px;
    color: white;
    text-decoration: none;
}

#body img{
    width: 100%;
    border-radius: 50px;
}

#body .background{
    background: url("../src/hannah.png") no-repeat;
    background-size: cover;
    height: 50vw;
    width: 100%;
    border-radius: 50px;
    margin: 20px 0;
    display: flex;
    flex-direction: column;
    align-items: center;
}

#body .title{
    display: flex;
    flex-direction: column;
    align-items: center;
    margin: 30px 0 0 0;
    font-size: 1.5vw;
}

#body .title h1{
    color: #FFFFFF;
}

#body .blob{
    background: url("../src/yellow_blob.png") no-repeat;
    width: 35vw;
    height: 20vw;
    background-size: 100% 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    align-self: start;
    margin: auto 0 auto 10%;
}

#body .blob p{
    width: 80%;
    color: #FFFFFF;
    font-size: 1.1vw;
}

#body .miv{
    height: 43vw;
    width: 100%;
    display: flex;
    justify-content: center;
}

#body .miv .misija{
    background: url('../src/red_blob.png') no-repeat;
    width: 40vw;
    height: 25vw;
    background-size: 100% 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
}

#body .miv .misija h1{
    margin: auto 0 0 0;
    font-size: 2vw;
}

#body .miv .misija p{
    margin: 0 0 auto 0;
    font-size: 1vw;
    padding: 0 4vw 0 4vw;
}

#body .miv .vizija{
    background: url("../src/pink_blob.png") no-repeat;
    width: 40vw;
    height: 30vw;
    background-size: 100% 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    align-self: end;
    margin: 0 0 30px 0;
}

#body .miv .vizija h1{
    margin: 4vw 0 0 0;
    font-size: 2vw;
}

#body .miv .vizija p{
    margin: 0 0 auto 0;
    font-size: 1vw;
    padding: 0 4vw 0 4vw;
}

#footer{
    background-color: #333333;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 10px 0 5px 0;
}

#footer a.logo{
    margin: 0 10px 0 0;
}

#footer a.name{
    text-decoration: none;
    color: white;
    margin: 0 20px 0 0;
}

#footer a.insta{
    margin: 0 10px 0 0;
}

</style>
<body>

<div id="main">
    <div id="body">
        <div class="background">
            <div class="title">
                <h1>ЗА НАС</h1>
                <h1>ОД ИДЕЈА ДО РЕАЛИЗАЦИЈА</h1>
            </div>
            <div class="blob">
                <p>Ние сме пет студенти од Факултетот за информатички науки и компјутерско инженерство (ФИНКИ), водени од желбата нашето знаење да го примениме за општествена корист. Со овој проект сакаме да покажеме дека технологијата може да биде повеќе од само алатка – може да биде мост помеѓу луѓето.</p>
            </div>
         </div>

         <div class="miv">
             <div class="misija">
                 <h1>МИСИЈА</h1>
                 <p>Инспирирани од предметот „Концепти на информатичкото општество“, решивме да обработиме тема која ќе има вистинско општествено влијание – апликација која ќе биде достапна и корисна за сите, без разлика на нивните разлики или животен стил.</p>
             </div>
             <div class="vizija">
                 <h1>ВИЗИЈА</h1>
                 <p>Во денешното динамично општество, многу луѓе тешко се
     справуваат со секојдневните обврски поради недостиг на време, енергија или ресурси. Тоа можат да бидат лица со попречувања, зафатени родители или амбициозни професионалци – но нашата апликација е отворена за секого што има потреба од помош.
    Од друга страна, постојат студенти, невработени или граѓани со слободно време – кои сакаат да заработат или помогнат. Затоа, нашата веб-апликација има за цел да ги поврзе овие две страни, создавајќи еден инклузивен дигитален простор за поддршка.</p>
             </div>
         </div>
    </div>
</div>

<div id="footer">
    <a class="logo" href=""><img class="logo" src="../src/logo.png" alt="" width="68" height="62"></a>
    <a class="name" href=""><h1>ТАСКО</h1></a>
    <a class="insta" href="">
        <img src="../src/Instagram.png" alt="" width="57" height="60">
    </a>
    <a class="fb" href="">
        <img src="../src/Facebook.png" alt="" width="45" height="44">
    </a>
    </div>
</body>
</x-app-layout>
