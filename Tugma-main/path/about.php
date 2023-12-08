<?php
include("header.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugma - Where Talent Meets Opportunity</title>
    <style>
  
body {
    font-family: 'Arial', sans-serif;
    margin-top: 10rem;
    padding: 0;
    background-color: #000;
    color: #fff;
}

.container {
    width: 80%;
    margin: 0 auto;
}

header {
    background-color: #111;
    color: #fff;
    padding: 20px 0;
    text-align: center;
}

section {
    margin: 20px 0;
}


h2 {
    color: #fff;
}

p {
    line-height: 1.6;
}


.container:nth-child(2),
.container:nth-child(3) {
    background-color: #222;
    padding: 20px;
}


.how-it-works {
    background-color: #000;
    padding: 20px;
}


.features {
    display: flex;
    justify-content: space-between;
}

.feature {
    width: 30%;
    padding: 15px;
    background-color: #111;
    margin-bottom: 20px;
    border: 1px solid #333;
    border-radius: 5px;
}


.why-tugma {
    background-color: #222;
    padding: 20px;
}

.diverse-artists,
.efficient-connections,
.collaborative-tools {
    width: 30%;
    padding: 15px;
    background-color: #111;
    margin-bottom: 20px;
    border: 1px solid #333;
    border-radius: 5px;
}


.button {
    display: inline-block;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    background-color: #111;
    color: #fff;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.button: {
    background-color: #333;
}

    </style>
</head>
<body>


    <header>
        <div class="container">
            <h1>Welcome to Tugma - Where Talent Meets Opportunity</h1>
            <p>Here at Tugma, we believe in the power of connection - the power to bring artists and publishers together. An idea created to help starting artists find their opportunity in an industry where opportunity is hard to come by. Tugma serves as a bridge between artists and publishers, encouraging collaboration and therefore creating new possibilities.</p>
        </div>
    </header>

    <section class="container">
        <h2>MISSION</h2>
        <p>To inspire and connect with audiences across the country through the creation and expression of exceptional music, fostering emotional resonance, cultural enrichment, and artistic innovation. We are dedicated to cultivating a supportive and collaborative environment for musicians and producers, empowering them to reach their full creative potential while contributing to the evolution of the Philippines musical landscape.</p>
    </section>

    <section class="container">
        <h2>VISION</h2>
        <p>We envision a future where musicians and publishers collaboratively shape a dynamic and inclusive musical landscape. We here at Tugma aim to be a driving force in the evolution of the music industry, where artists and publishers work together to discover, promote, and distribute extraordinary music.</p>
    </section>

    <section class="container how-it-works">
        <h2>HOW TUGMA WORKS</h2>
        <p>Tugma operates on the principle of simplicity and efficiency. Artists can make an account where they post their ideas, abilities, personality, and of course, their collection of work. Users and publishers can sort through this varied pool of artists, with different experience, skills, styles, and genres, to help you find the exact person you are looking for. Tugma is designed to be a platform that is intuitive, offering artists and publishers the means to find each other by giving them access to features such as; the ability to post, comment, and rate. We believe these three features are the catalyst to collaboration and connection. Tugma ensures that the focus remains on what matters most – the music.</p>
    </section>

    <section class="container why-tugma">
        <h2>WHY TUGMA?</h2>
        <div class="features">
            <div class="diverse-artists">
                <h3>Diverse Artists</h3>
                <p>A platform full of personality. From indie artists to global icons, a beginner or a pro. Tugma serves as a bridge that connects different artists and publishers together.</p>
            </div>
            <div class="efficient-connections">
                <h3>Efficient Connections</h3>
                <p>Tugma works tirelessly to help artists and publishers find the right person for the right job. Say goodbye to endless searches and hello to meaningful connections.</p>
            </div>
            <div class="collaborative-tools">
                <h3>Collaborative Tools</h3>
                <p>Our platform provides the tools needed for seamless collaboration. Post videos, share ideas, and create extraordinary art together.</p>
            </div>
        </div>
    </section>

</body>
</html>
<?php
include("footer.php");
?>