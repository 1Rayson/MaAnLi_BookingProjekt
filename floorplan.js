
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

    console.log("/backend_floorplan.php?date=" + date + "&start-time-input="+startHour+":"+startMinute+"&end-time-input="+endHour+":"+endMinute);

    fetch("/backend_floorplan.php?date=" + date + "&start-time-input="+startHour+":"+startMinute+"&end-time-input="+endHour+":"+endMinute)
        .then(res => res.json())
        .then(data => colorFloorplan(data.unavailableList, data.partlyAvailableList))
}


/* ----- Coloring rooms based on the two lists ----- */
function colorFloorplan(unavailableRooms, partlyAvailableRooms){

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
                room.addEventListener("click", function() {selectRoom(room.id)});
                return
            }
        }
    
        room.className += " available";
        room.addEventListener("click", function() {selectRoom(room.id)});
    });
}


/* nothing yet */
function selectRoom(roomID){
    fetch("/backend_floorplan.php?roomid="+roomID)
        .then(res => res.json())
        .then(data => colorFloorplan())
}

checkAvailability();

/* kan sende via url, eller som "include" i body så vil det være POST i stedet. */