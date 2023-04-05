
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

function getExtension(filename) {
    return filename.split('.').pop();
}

function preview(user, filename){
    if(getExtension(filename) !== 'pdf'){
        let popup = document.querySelector('.popUp_preview');
        let backgroundBlack = document.querySelector('.background_black');
    
        let img = document.createElement('img');
        img.src = 'upload/'+user+'/'+filename;
        popup.style.display = 'flex';
        popup.style.justifyContent = 'center';
        popup.style.alignItems = 'center';
        popup.style.flexDirection = 'column';
        popup.style.backgroundColor = '#333';
        popup.style.width = img.width+ 10 + 'px';
        popup.style.height = img.height+ 10 + 'px';
    
        backgroundBlack.style.display = 'block';
    
    
        let closeButton = document.createElement('button');
        closeButton.innerHTML = 'X';
        //make close button in the top right corner
        closeButton.style.position = 'absolute';
        closeButton.style.top = '0';
        closeButton.style.right = '0';
        closeButton.style.margin = '10px';
        closeButton.style.padding = '5px';
        closeButton.style.backgroundColor = 'red';
        closeButton.style.color = 'white';
        closeButton.style.fontSize = '20px';
        closeButton.style.fontWeight = 'bold';
        closeButton.style.cursor = 'pointer';
    
        closeButton.classList.add('closeButton');
    
        popup.appendChild(closeButton);
    
    
        img.classList.add('previewImage');
        //center the image
        img.style.margin = 'auto';
        img.style.display = 'block';
        img.style.maxWidth = '100%';
        img.style.maxHeight = '100%';
        popup.appendChild(img);
    
        //center the popup
        popup.style.margin = 'auto';
        popup.style.position = 'absolute';
        popup.style.top = '0';
        popup.style.left = '0';
        popup.style.bottom = '0';
        popup.style.right = '0';
    
        closeButton.addEventListener('click', function(){
            popup.style.display = 'none';
            backgroundBlack.style.display = 'none';
            img.remove();
            closeButton.remove();
        });
    }else{
        window.open('upload/'+user+'/'+filename);
    }

}
function download(user, filename){
   //download the file in ../uploads/user/filename

   let downloadLink = document.createElement('a');
    downloadLink.href = 'upload/'+user+'/'+filename;
    downloadLink.download = filename;
    downloadLink.click();

}



document.addEventListener('DOMContentLoaded', function() {
    main();
    
});