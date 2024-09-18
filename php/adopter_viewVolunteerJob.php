<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pet Shelter Volunteer</title>
    <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
  <style>
     * {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    border: none;
    outline: none;

}

body {
    background-color: white;
}

.nav-container {
    display: flex;
    flex-wrap: inherit;
    align-items: center;
    justify-content: space-between;
}

.navbar {
    position: fixed;
    left: 0;
    z-index: 999;
    width: 100%;
    top: 0;
    background-color: pink;
}

.contain {
    height: 600px;
    padding: 20px;
    margin-left: 40px;
    margin-right: 40px;
    margin-top: 40px;
    display: flex;
    flex-direction: row-reverse;
    justify-content: space-between;
    align-items: center;
    gap: 40px;

}

.contain img {
    width: inherit;
    margin-right: 100px;
    height: 500px;
}

.hero-text h1 {
    font-size: 3.3rem;
    margin-bottom: 8px;
    color: hotpink;
}

.hero-text p {
    font-size: 1.4rem;
    margin-bottom: 12px;
}

button {
    padding: 1em 2.1em 1.1em;
    border: radius 4px;
    margin: 8px;
    border: none;
    background-color: pink;
    font-weight: 800;
    font-size: 0.85em;
    text-transform: uppercase;
    text-align: center;
    box-shadow: 0em -0.2em 0em white inset;

}

@media(max-width:884px) {
    .contain {
        margin-top: 10px;
        flex-direction: column;
    }

    .hero-text {
        width: 100%;
        text-align: center;
    }

    .hero-text h1 {
        font-size: 3rem;
    }
}

@media only screen and (min-width: 992px) {
    .navbar__navitem {
        /* border-right: 1px solid rgba(255, 255, 255, 0.2); */
        border-right: 1px solid black;
        padding: 0 20px;
    }
}

.center {
    margin: auto;
    width: 60%;
    padding: 10px;
}

.button-value{
    border: 2px solid rgb(218, 116, 131);
    padding: 0.5em 1.5em;
    border-radius: 3em;
    background-color:transparent ;
    color: rgb(218, 116, 131);
    cursor: pointer;

}
.active{
    background-color:rgb(218, 116, 131); 
    color: white;
    padding: 1em 2.1em 1.1em;
    border: radius 4px;
    margin: 8px;
    border: none;

    font-weight: 800;
    font-size: 0.85em;
    text-transform: uppercase;
    text-align: center;
    box-shadow: 0em -0.2em 0em white inset;
}

#listOfVolunteer{
    display: grid;
    grid-template-columns: auto auto auto;
    grid-column-gap:1.5em ;
    padding: 2em 0;
}

.volunteerCard{
    background-color: white;
    max-width:18em;
    margin-top: 1em;
    padding: 1em;
    border-radius:5px ;
    box-shadow: 1em 2em 2.5em rgba(1, 2, 68, 0.08);
}

.volunteerCard:hover{
    outline: .2rem solid rgb(185, 182, 182) ;

}
.image-container{
text-align: center;
}

img{
    max-width: 100%;
    object-fit: contain;
    height:15em;
}
.container{
    padding-top:1 em ;
   color: #110f29;
    
}
.container h5{
    font-weight: 500;
}

@media screen and(max-width:720px){
    img{
        max-width: 100%;
        object-fit:contain;
        height: 10em;
    }
    .card{
        max-width: 10em;
        margin-top: 1em;

    }
    #products{
        grid-template-columns: auto auto;
        grid-column-gap:1em ;
    }
}

.popup {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.popup-content {
    display: flex;
    max-width: 800px;
    background-color: #fff;
    border-radius: 5px;
    overflow: hidden;
    position: relative;
}

.popup-header {
    position: absolute;
    top: 10px;
    right: 10px;
}

.close-btn {
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
}

.popup-image {
    flex: 1;
    max-width: 50%;
}

.popup-image img {
    width: 100%;
    height: auto;
    display: block;
}

.popup-info {
    flex: 1;
    padding: 20px;
    text-align: center;
    position: relative;
}

.popup-info h3 {
    margin-top: 0;
}


.hide{
    display: none;
}
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.4);
}

.modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 500px;
}

.x-btn {
    color: #aaa;
    position: relative;
 
    font-size: 15px;
    top: -10px;
    right: -450px;
    font-weight: bold;
    cursor: pointer;
}

.x-btn:hover,
.x-btn:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
.volunteer-btn {
    background-color: lightpink;
 /* Hot pink background */
 border-radius: 15px;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold;

    cursor: pointer;
    transition: background-color 0.3s, transform 0.3s;
   
    margin-top: 20px;
}

.volunteer-btn:hover {
    background-color: #ff1493;
    transform: scale(1.05); 
}

.volunteer-btn:active {
    transform: scale(0.95); 
}
input[type="radio"] {
    margin-right: 10px;
}

input[type="radio"] + label {
    display: inline-block;
    margin-right: 20px;
    font-weight: normal;
}
  </style>
</head>
<body>
<header>

    <nav class="navbar navbar-expand-lg">
      <div class="container navbar__container">
        <a class="logo navbar-brand" href="../public.html">Pet Adoption</a>

        <button class="navbar-toggler navbar__toggler" type="button" data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon navbar__toggler--icon">
            <i class="fas fa-bars"></i>
            <i class="fas fa-times"></i>
          </span>
        </button>

        <div id="primaryNav">
          <div class="navbar-collapse collapse" id="navbarSupportedContent" style>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="navbar__navitem nav-item">
                <a class="navbar__navlink nav-link" href="#home">Home</a>
              </li>
              <li class="navbar__navitem nav-item">
                <a class="navbar__navlink nav-link" href="">Pet List</a>
              </li>
              <li class="navbar__navitem nav-item">
                <a class="navbar__navlink nav-link" href="#condition">Adoption Condition</a>
              </li>
              <li class="navbar__navitem nav-item">
                <a class="navbar__navlink nav-link" href="#aboutus">About Us</a>
              </li>
            </ul>
          </div>
        </div>

        <div id="userNav" class="navbar-nav mr-auto ml-auto align-items-center">
          <a href="menu.php">
            <img src="../img/user.png" style="width: 30px; height: 30px;">
          </a>

          <!-- <a href="logout.php" class="btn btn-dark" style="margin-left: 20px;">Logout</a> -->
        </div>
      </div>
    </nav>
  </header>
  <main>
    <div class="contain">
      <img src="../img/volunteer_hero.jpg" alt="">
      <div class="hero-text">
        <h1>Volunteer Opportunities in Our Shelter</h1>
        <p>"Share the Love, Change a Life: Volunteer at Our Pet Shelter!"</p>
        <button>Contact us</button>
      </div>
    </div>
  </main>

  <div id="listOfVolunteer"></div>

    <script>

        function createVolunteerPopup(volunteerData) {
        const popup = document.createElement('div');
        popup.classList.add('popup');

        const popupHeader = document.createElement('div');
        popupHeader.classList.add('popup-header');

        const closeBtn = document.createElement('span');
        closeBtn.classList.add('close-btn');
        closeBtn.textContent = 'X';
        closeBtn.addEventListener('click', () => {
            popup.remove();
        });
        popupHeader.appendChild(closeBtn);

        popup.appendChild(popupHeader);

        const popupContent = document.createElement('div');
        popupContent.classList.add('popup-content');

        const popupImage = document.createElement('div');
        popupImage.classList.add('popup-image');
        const image = document.createElement('img');
        image.src = volunteerData.image;
        popupImage.appendChild(image);
        popupContent.appendChild(popupImage);

        const popupInfo = document.createElement('div');
        popupInfo.classList.add('popup-info');

        const popupName = document.createElement('h3');
        popupName.textContent = volunteerData.title;
        popupInfo.appendChild(popupName);

        const popupDescription = document.createElement('p');
        popupDescription.textContent = `Job description: ${volunteerData.description}`;
        popupInfo.appendChild(popupDescription);

        const popupRequirements = document.createElement('p');
        popupRequirements .textContent = `Requirements: ${volunteerData.requirements}`;
        popupInfo.appendChild(popupRequirements );

        const popupDate = document.createElement('p');
        popupDate.textContent = `Volunteering date: ${volunteerData.date}`;
        popupInfo.appendChild(popupDate);
      const volunteerBtn = document.createElement('button');
            volunteerBtn.textContent = 'Become a volunteer';
            volunteerBtn.className = 'volunteer-btn';
            volunteerBtn.onclick = function () {
                const modal = createVolunteerModal(volunteerData.title);
                document.body.appendChild(modal);
                modal.style.display = 'block';
                popup.remove();
            };
            popupInfo.appendChild(volunteerBtn);
        popupContent.appendChild(popupInfo);
        popup.appendChild(popupContent);

        document.body.appendChild(popup);
    }

function createVolunteerModal(title) {
    const modal = document.createElement('div');
    modal.classList.add('modal');

    const modalContent = document.createElement('div');
    modalContent.classList.add('modal-content');

    const closeBtn = document.createElement('span');
    closeBtn.classList.add('x-btn');
    closeBtn.textContent = 'X';
    closeBtn.onclick = function() {
        modal.style.display = 'none';
    };

    const head = document.createElement('h3');
    head.textContent = `${title} Application Form`;

    const form = document.createElement('form');
form.innerHTML = `
<br>
    <input type="hidden" id="title" name="title" value="${title}">
    <label for="name">Your Name:</label>
    <input type="text" id="volunteerName" name="volunteerName" required><br><br>

    <label for="volunteerEmail">Your Email:</label>
    <input type="email" id="volunteerEmail" name="volunteerEmail" required><br><br>

    <label for="volunteerPhone">Your Phone:</label>
    <input type="tel" id="volunteerPhone" name="volunteerPhone" required><br><br>
     <label for="volunteerAddress">Your Address:</label>
    <input type="text" id="volunteerAddress" name="volunteerAddress" required><br><br>
        <label>Do you have any volunteer experience?</label><br>
    <input type="radio" id="yes_experience" name="experienced" value="yes" required>
    <label for="yes_experience">Yes</label><br>
    <input type="radio" id="no_experience" name="experienced" value="no" required>
    <label for="no_experience">No</label><br><br>
  <label for="reasons">Why are you interested in becoming volunteer for ${title} : </label>
    <input type="text" id="reasons" name="reasons" required><br><br>
    <button type="submit">Apply</button>
`;

form.onsubmit = function(e) {
    e.preventDefault();
    const formData = new FormData(form);

    fetch('adopter_volunteerRequest.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert(data.message);
            modal.remove();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while submitting the form.');
    });
};

    modalContent.appendChild(closeBtn);
    modalContent.appendChild(head);
    modalContent.appendChild(form);
    modal.appendChild(modalContent);
    return modal;
}
</script>

    <?php
    include("db_conn.php");


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM volunteerTable";
    $result = $conn->query($sql);

    $volunteerJobs = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $volunteerJobs[] = $row;
        }
    }

    ?>
    <script>

        let listOfVolunteer = <?php echo json_encode($volunteerJobs); ?>;
     function createVolunteerCard(volunteerData) {
    let volunteerCard = document.createElement("div");
    volunteerCard.classList.add("volunteerCard");
    
    let imgContainer = document.createElement("div");
    imgContainer.classList.add("image-container");

    let image = document.createElement("img");
    if (volunteerData.image) {
        image.setAttribute("src", volunteerData.image); 
    }

    imgContainer.appendChild(image);
    volunteerCard.appendChild(imgContainer);

    let container = document.createElement("div");
    container.classList.add("container");

    let jobtitle = document.createElement("h5");
    jobtitle.classList.add("title");
    if (volunteerData.title) {
        jobtitle.innerText =volunteerData.title.toUpperCase();
    }
    container.appendChild(jobtitle);

    let date= document.createElement("h6");
    if (volunteerData.date) {
        date.innerText = `Volunteering Date: ${volunteerData.date}`;
    }
    container.appendChild(date);

    let postedDate = document.createElement("p");
    if (volunteerData.created_at) {
        postedDate.innerText = `Posted by: ${volunteerData.created_at}`;
    }
    container.appendChild(postedDate);

   volunteerCard.appendChild(container);

   volunteerCard.addEventListener('click', () => {
            createVolunteerPopup(volunteerData);
        });
    return volunteerCard;
}

        listOfVolunteer.forEach(volunteer => {
            console.log("Creating card for:", volunteer.title);
            let volunteerCard = createVolunteerCard(volunteer);
            document.getElementById("listOfVolunteer").appendChild(volunteerCard);

        });
    </script>
    <?php
    $conn->close();
    ?>
</body>
</html>