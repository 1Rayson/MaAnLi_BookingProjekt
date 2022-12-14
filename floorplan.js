
/* ----- Changing floor ----- */
let floorIndex = 0
switchFloor(floorIndex);

function switchFloor(floor){
    let i;
    let floorBtns = document.getElementsByClassName('floor-btns');
    let gridWrapper = document.getElementById('grid-wrapper');
    let procentValue = floor * -100;

    gridWrapper.style.left = procentValue + "%";

    for (i = 0; i < floorBtns.length; i++){
        floorBtns[i].className = floorBtns[i].className.replace(" active-floor-btns", "");
    }
    floorBtns[floor].className += " active-floor-btns";
}


/* ----- Creating unavailable and partly unavailable lists ----- */
const rooms = document.querySelectorAll('.room');

let url = new URL(window.location)
 
document.getElementById("date").value = url.searchParams.get("date");
document.getElementById("start_hour").value = url.searchParams.get("start-hour");
document.getElementById("start_minute").value = url.searchParams.get("start-minute");
document.getElementById("end_hour").value = url.searchParams.get("end-hour");
document.getElementById("end_minute").value = url.searchParams.get("end-minute");

async function checkAvailability (){
    let date = document.getElementById("date").value;
    let startHour = document.getElementById("start_hour").value;
    let startMinute = document.getElementById("start_minute").value;
    let endHour = document.getElementById("end_hour").value;
    let endMinute = document.getElementById("end_minute").value;

    fetch("/backend_floorplan.php?date=" + date + "&start-time-input="+startHour+":"+startMinute+"&end-time-input="+endHour+":"+endMinute)
        .then(res => res.json())
        .then(data => colorFloorplan(data.unavailableList, data.partlyAvailableList))
}


/* ----- Coloring rooms based on the two lists ----- */
function colorFloorplan(unavailableRooms, partlyAvailableRooms){
    let date = document.getElementById("date").value;

    rooms.forEach(room => {
        room.classList.remove("unavailable");
        room.classList.remove("partly-available");
        room.classList.remove("available");
    });
    
    rooms.forEach(room => {
        for(i=0; i<unavailableRooms.length; i++){
            if(room.id == unavailableRooms[i].id){
                room.className += " unavailable";
                return
            }
        }
    
        for(i=0; i<partlyAvailableRooms.length; i++){
            if (room.id == partlyAvailableRooms[i].id){
                room.className += " partly-available";
                room.addEventListener("click", function() {selectRoom(room.id, date)});
                return
            }
        }
    
        room.className += " available";
        room.addEventListener("click", function() {selectRoom(room.id, date)});
    });
}


/* nothing yet */
async function selectRoom(roomID, date){
    fetch("/backend_floorplan.php?roomid="+roomID+"&date="+date)
        .then(res => res.json())
        .then(data => {
            let roomInfo = data.roomInfo;
            let roomBookingsInfo = data.roomBookingsInfo;

            let roomInfoHtml = `
                <h2>Lokale</h2>
                <p id="roomNumberInfo">${roomInfo[0].floorVariable+"."+roomInfo[0].roomNumber}</p>
                <h2>Faciliteter</h2>
                <p id="capacity">Antal siddepladser: ${roomInfo[0].capacity}</p>
                <p id="screen">Antal skærme: ${roomInfo[0].screen}</p>
                <p id="smartboard">Antal smartboard: ${roomInfo[0].smartBoard}</p>
            `;

            let bookingsOfTheDayHtml = "";

            roomBookingsInfo.forEach(booking => {
                bookingsOfTheDayHtml += `
                    <article class="booking-details">
                        <section class="date-time-location">
                            <p class="time-interval">${booking.start_time} - ${booking.end_time}</p>
                        </section>
                        <section class="organizer">
                            <p id="description">${booking.booking_description}</p>
                        </section>
                    </article>
                    <section class="divider">
                            <hr>
                    </section>
                    `;
            });

            let date = document.getElementById('date').value;
            let startHour = document.getElementById('start_hour').value;
            let startMinute = document.getElementById('start_minute').value;
            let endHour = document.getElementById('end_hour').value;
            let endMinute = document.getElementById('end_minute').value;

            let popUpHtml = `
                <form action="backend.php?action=create&roomid=${roomID}" method="post">
                    <h2>Lokale</h2>
                    <div>
                        <input type="text" name="room_var" value="${roomInfo[0].floorVariable}" readonly>
                        .
                        <input type="number" name="room_number" value="${roomInfo[0].roomNumber}" readonly>
                    </div>
                    <h2>Dato</h2>
                    <input type="date" name="booking_date" value="${date}" readonly>
                    <h2>Tidsrum</h2>
                    <div>
                        <input type="time" name="start_time" value="${startHour}:${startMinute}" readonly>
                        <p> - </p>
                        <input type="time" name="end_time" value="${endHour}:${endMinute}" readonly>
                    </div>
                    <h2>Booking beskrivelse</h2>
                    <input type="text" name="booking-description" id="booking-description-input" minlength="1" maxlength="50">
                    <input type="submit" value="Bekræft">
                </form>
            `;
            
            document.getElementById("room-info").innerHTML = roomInfoHtml;
            document.getElementById("bookingsOnTheDay").innerHTML = bookingsOfTheDayHtml;
            document.getElementById("pop-up-main-content").innerHTML = popUpHtml; 
        })

}

function popUp(){
    document.getElementById("pop-up-confirmation").style.display = "block";
}

function popDown(){
    document.getElementById("pop-up-confirmation").style.display = "none";
}

checkAvailability();

/* kan sende via url, eller som "include" i body så vil det være POST i stedet. */