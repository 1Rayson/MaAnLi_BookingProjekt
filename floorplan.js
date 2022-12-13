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

const rooms = document.querySelectorAll('.room');

async function checkAvailability (){

    let url = new URL(window.location)
    let date = url.searchParams.get("date");
    let startTime = url.searchParams.get("start-time-input");
    let endTime = url.searchParams.get("end-time-input");

    fetch("/backend_floorplan.php?date=" + date + "&start-time-input="+startTime+"&end-time-input="+endTime)
        .then(res => res.json())
        .then(data => colorFloorplan(data.unavailableList, data.partlyAvailableList))
}

function colorFloorplan(unavailableRooms, partlyAvailableRooms){

    rooms.forEach(room => {
        room.className.replace(" unavailable", "");
        room.className.replace(" partly-available", "");
        room.className.replace(" available", "");
    });
    
    rooms.forEach(room => {
        for(i=0; i<unavailableRooms.length; i++){
            if(room.id == "r" + unavailableRooms[i].floorVariable + unavailableRooms[i].roomNumber){
                room.className += " unavailable";
                return
            }
        }
    
        for(i=0; i<partlyAvailableRooms.length; i++){
            if (room.id == "r" + partlyAvailableRooms[i].floorVariable + partlyAvailableRooms[i].roomNumber){
                room.className += " partly-available";
                room.addEventListener("click", function() {selectRoom(room.id)});
                return
            }
        }
    
        room.className += " available";
        room.addEventListener("click", function() {selectRoom(room.id)});
    });
}

function selectRoom(roomID){
    console.log(roomID);
}

checkAvailability();

/* kan sende via url, eller som "include" i body så vil det være POST i stedet. */