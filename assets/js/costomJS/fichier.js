
function main(){
    //RIB, Ci, SS
    let RIB = document.getElementById('RIB'); // RIB is a input of file type
    let Ci = document.getElementById('CI');
    let SS = document.getElementById('SS');

    let RIPInputField = document.getElementById('RIPText');
    let CiInputField = document.getElementById('CIText');
    let SSInputField = document.getElementById('SSText');


    RIB.addEventListener('change', function(){
        console.log(RIB.files[0].name);
        RIPInputField.value = RIB.files[0].name;
    }
    );

    Ci.addEventListener('change', function(){
        console.log(Ci.files[0].name);
        CiInputField.value = Ci.files[0].name;
    }

    );

    SS.addEventListener('change', function(){
        console.log(SS.files[0].name);
        SSInputField.value = SS.files[0].name;
    }
    );
}

document.addEventListener('DOMContentLoaded', function() {
    main();
    
});