<x-app-layout>

<style>
    *{
    margin: 0;
    padding: 0;
}

body{
    font-family: "Open Sans";
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

#body .background{
    background: url("./src/pocetna_bkr.png") no-repeat;
    background-size: cover;
    height: 50vw;
    width: 100%;
    border-radius: 50px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

#body .background .title{
    display: flex;
    flex-direction: column;
    align-items: center;
    font-size: 1.5vw;
    margin-top: auto;
    padding-top: 5vw;
    width: 70vw;
}

#body .background .title h1{
    color: #FFFFFF;
    text-shadow: 2px 2px 6px black;
}

#body .background .title p{
    text-align: center;
    color: white;
}

#body .background button{
    display: flex;
    align-items: center;
    justify-content: start;
    border: none;
    border-radius: 3vw;
    padding: 1.1vw;
    height: 4.5vw;
    width: 17vw;
    margin: 2vw 0 auto 0;
}

#body .background button p{
    font-size: 1.5vw;
    margin: 0 0.6vw 0 0;
}

#body .background button .circle{
    margin: 0 auto 0 auto;
    height: 3vw;
    width: 3vw;
    border-radius: 100%;
    background: linear-gradient(to right, #fadeee, #F1808D);
    display: flex;
    justify-content: center;
    align-items: center;
}

#body .background button .circle .arrow{
    background: url("./src/arrow.png") no-repeat;
    background-size: cover;
    width: 1vw;
    height: 1vw;
}

#body .background .msg{
    align-self: end;
    margin: 0 5vw 0 0;
    width: 25vw;
    height: 7vw;
    padding: 1vw;
    border-radius: 2vw;
    font-size: 1vw;
    backdrop-filter: blur(20px);
    margin-bottom: auto;
}

#body .background .msg p{
    color: white;
}

#body .kategorii .title{
    display: flex;
    justify-content: center;
    margin: 4vw 0 4vw 0;
}

#body .kategorii .title h1{
    font-size: 2.5vw;

}
#body .kategorii .grid-kategorii{
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
    grid-row-gap: 1vw;
    margin: 0 0 5vw 0;
}

#body .kategorii .grid-kategorii .grid-item{
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
}

#body .kategorii .grid-kategorii .grid-item img{
    width: 17vw;
    height: 16vw;
}

#body .kategorii .grid-kategorii .grid-item p{
    font-size: 1vw;
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
                <h1>ДОБРЕДОЈДE НА ТАСКО</h1>
                <p>Паметна веб-платформа што ги поврзува зафатените со оние што сакаат да помогнат и заработат – најди човек за секоја обврска, лесно и без компликации. Стани услужувач, искористи ги своите вештини и заработувај кога и колку што сакаш!</p>
            </div>
            <a class="register" href="{{route('register')}}"><p>Регистрирај се</p>
                <div class="circle">
                    <div class="arrow"></div>
                </div>
            </a>
            <div class="msg">
                <p>ТАСКО – Поврзи се. Помогни. Заработи.</p>
                <p>Запознај луѓе од различни возрасти и
професии преку tasks. Изгради ја својата општествена мрежа додека заработуваш , стекнуваш доверба и градиш пријателства. </p>
            </div>
         </div>

         <div class="kategorii">
             <div class="title">
                <h1>Достапни категории:</h1>
             </div>
             <div class="grid-kategorii">
                 <div class="grid-item">
                     <img src="./src/kategorii/cistenje.png" alt="">
                     <p>Чистење</p>
                 </div>
                 <div class="grid-item">
                     <img src="./src/kategorii/dostava.png" alt="">
                     <p>Достава и пазарење</p>
                 </div>
                 <div class="grid-item">
                     <img src="./src/kategorii/milenici.png" alt="">
                     <p>Грижа за миленици</p>
                 </div>
                 <div class="grid-item">
                     <img src="./src/kategorii/kopjuteri.png" alt="">
                     <p>Техничка помош</p>
                 </div>
                 <div class="grid-item">
                     <img src="./src/kategorii/casovi.png" alt="">
                     <p>Приватни часови и едукација</p>
                 </div>
                 <div class="grid-item">
                     <img src="./src/kategorii/stari.png" alt="">
                     <p>Грижа за стари</p>
                 </div>
                 <div class="grid-item">
                     <img src="./src/kategorii/dvor.png" alt="">
                     <p>Грижа за дворот</p>
                 </div>
                 <div class="grid-item">
                     <img src="./src/kategorii/nosenje.png" alt="">
                     <p>Селидба и носење</p>
                 </div>
                 <div class="grid-item">
                     <img src="./src/kategorii/slikanje.png" alt="">
                     <p>Сликање</p>
                 </div>
                 <div class="grid-item">
                     <img src="./src/kategorii/majstor.png" alt="">
                     <p>Мајсторски услуги</p>
                 </div>
             </div>
         </div>
    </div>
</div>

<div id="footer">
    <a class="logo" href=""><img class="logo" src="./src/logo.png" alt="" width="68" height="62"></a>
    <a class="name" href=""><h1>ТАСКО</h1></a>
    <a class="insta" href="">
        <img src="./src/Instagram.png" alt="" width="57" height="60">
    </a>
    <a class="fb" href="">
        <img src="./src/Facebook.png" alt="" width="45" height="44">
    </a>
    </div>
</body>


</x-app-layout>