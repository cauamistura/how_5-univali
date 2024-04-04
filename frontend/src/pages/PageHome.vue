<template>
    <!DOCTYPE html>
    <!-- Created By CodingNepal -->
    <html lang="en" dir="ltr">

    <head>
        <meta charset="utf-8">
        <!-- <title>Responsive Sidebar Menu</title> -->
        <link rel="stylesheet" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    </head>

    <body>
        <input type="checkbox" id="check">
        <label for="check">
            <i class="fas fa-times" id="cancel"></i>
            <i class="fas fa-bars" id="btn"></i>

        </label>
        <div class="sidebar">
            <header>
                <i class="fa fa-shopping-cart"></i>
                Feirinha
            </header>
            <a href="#" class="active">
                <i class="fas fa-home"></i>
                <span>Início</span>
            </a>
            <a href="#">
                <i class="fa fa-user"></i>
                <span>Minha conta</span>
            </a>
            <a href="#">
                <i class="fas fa-stream"></i>
                <span>Balanço</span>
            </a>
            <a href="#">
                <i class="fa fa-dropbox"></i>
                <span>Meus produtos</span>
            </a>
            <a href="#">
                <i class="far fa-question-circle"></i>
                <span>Sobre</span>
            </a>
        </div>
    </body>

    </html>
</template>

<script>
export default {

}
</script>

<style>

* {
    margin: 0;
    padding: 0;
    text-decoration: none;
}

.sidebar {
    position: fixed;
    width: 240px;
    left: -240px;
    height: 100%;
    background: #F6F8F9;
    transition: all .5s ease;

    display: flex;
    flex-direction: column;
    align-items: center;

    left: 0;
}

.sidebar header {
    font-size: 18px;
    color: #252C32;
    line-height: 50px;
    background: #F6F8F9;
}

.sidebar a {
    height: 35px;
    width: 90%;
    color: black;
    transition: all .5s ease;
    border-radius: 13%;
    font-size: 14;

    display: flex;
    justify-content: left;
    align-items: center;
}

.sidebar a>i {
    margin-left: 6%;
    height: auto;
    color: #84919A;
}

a.active,
a:hover {
    background-color: #D7EDFF;
    color: #1f6bc2;
}

.sidebar a i {
    font-size: 23px;
    margin-right: 16px;
}

.sidebar a span {
    letter-spacing: 1px;
    text-transform: uppercase;
}

#check {
    display: none;
}

label #btn,
label #cancel {
    position: absolute;
    cursor: pointer;
    color: white;
    border-radius: 5px;
    border: 1px solid #262626;
    margin: 15px 30px;
    font-size: 29px;
    background: #262626;
    height: 45px;
    width: 45px;
    text-align: center;
    line-height: 45px;
    transition: all .5s ease;
}

label #cancel {
    opacity: 0;
    visibility: hidden;
}

#check:checked~.sidebar {
    left: 0;
}

#check:checked~label #btn {
    margin-left: 245px;
    opacity: 0;
    visibility: hidden;
}

#check:checked~label #cancel {
    margin-left: 245px;
    opacity: 1;
    visibility: visible;
}

@media(max-width : 860px) {
    .sidebar {
        height: auto;
        width: 70px;
        left: 0;
        margin: 100px 0;
    }

    header,
    #btn,
    #cancel {
        display: none;
    }

    span {
        position: absolute;
        margin-left: 23px;
        opacity: 0;
        visibility: hidden;
    }

    .sidebar a {
        height: 60px;
    }

    .sidebar a i {
        margin-left: -10px;
    }

    a:hover {
        width: 200px;
        background: inherit;
    }

    .sidebar a:hover span {
        opacity: 1;
        visibility: visible;
    }
}
</style>