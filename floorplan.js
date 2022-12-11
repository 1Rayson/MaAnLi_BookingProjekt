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

/* Kun midlertidig objekt array til test */
let unavailableRooms = [
    {
        roomNumber: "30",
        floorVariable: "s",
    },
    {
        roomNumber: "17",
        floorVariable: "1"
    },
    {
        roomNumber: "44",
        floorVariable: "1"
    },
    {
        roomNumber: "20",
        floorVariable: "2"
    },
    {
        roomNumber: "38",
        floorVariable: "2"
    },
];

/* Kun midlertidig objekt array til test */
let partlyAvailableRooms = [
    {
        roomNumber: "01",
        floorVariable: "1"
    },
    {
        roomNumber: "24",
        floorVariable: "1"
    },
    {
        roomNumber: "11",
        floorVariable: "2"
    },
    {
        roomNumber: "26",
        floorVariable: "2"
    }
]

let rooms = document.querySelectorAll('.room');

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

function selectRoom(roomID){
    console.log(roomID);
}

/* kan sende via url, eller som "include" i body så vil det være POST i stedet. */