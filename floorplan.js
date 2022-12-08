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

let bookings = [
    {
        fullName: "Test subject1",
        roomNumber: "30",
        floorVariable: "s",
        start_time: "2022-12-08",
        end_time: ""
    },
    {
        fullName: "Test subject2",
        roomNumber: "01",
        floorVariable: "1"
    },
    {
        fullName: "Test subject3",
        roomNumber: "17",
        floorVariable: "1"
    },
    {
        fullName: "Test subject4",
        roomNumber: "24",
        floorVariable: "1"
    },
    {
        fullName: "Test subject15",
        roomNumber: "44",
        floorVariable: "1"
    },
    {
        fullName: "Test subject6",
        roomNumber: "11",
        floorVariable: "2"
    },
    {
        fullName: "Test subject7",
        roomNumber: "20",
        floorVariable: "2"
    },
    {
        fullName: "Test subject8",
        roomNumber: "26",
        floorVariable: "2"
    },
    {
        fullName: "Test subject9",
        roomNumber: "38",
        floorVariable: "2"
    },
];

let rooms = document.querySelectorAll('.room');

rooms.forEach(room => {
    room.className.replace(" unavailable", "");
    room.className.replace(" available", "");
});

rooms.forEach(room => {
    for(i=0; i<bookings.length; i++){
        if(room.id == "r" + bookings[i].floorVariable + bookings[i].roomNumber){
            room.className += " unavailable";

            const d = new Date("1922-03-25");
        } else {
            room.className += " available";
        }
    }
});

/* Til delvist ledigt, kan bruge MySQL query: 
ligger VALGT start tid mellem BOOKET start og slut tid, 
eller ligger VALGT slut tid mellem BOOKET start og slut tid. */

/* Kan starte med at lave en liste over alle rum, som er booket bare et minut i valgt tidsrum.
Dem der ikke er på den liste gemmer jeg i et array, og looper igennem arrayet for at tilføje styling.
Resten kan jeg tjekke for om VALGT start tiden ligger før BOOKET start tid og om VALGT slut tid ligger efter BOOKET slut tid,
i så fald vil det være "unavailable" ellers vil det være "partly-available" */

/* Bliver nok nød til at omregne dato til antal millisekunder siden 1970, og så samligne det på en eller anden måde */

/* Eller kan man med MySQL query tjekke om hver booking ligger indenfor valgt start og slut tidspunkt? */