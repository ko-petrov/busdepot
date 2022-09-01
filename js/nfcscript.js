// const myfunction = async function() {
//   const ndef = new NDEFReader();
//     await ndef.scan();
//     ndef.addEventListener("reading", ({ message }) => {
//       for (const record of message.records) {
//         if (record.recordType == "text") {
//           const textDecoder = new TextDecoder(record.encodeing);
//           const text = textDecoder.decode(record.data);
//           console.log('text: ${text}');
//         }
//       }
//     });
// }


// const start = async function() {
//   const result = await myfunction();
// }


// start();





// const ndef = new NDEFReader();
// let ignoreRead = false;

// ndef.onreading = (event) => {
//   if (ignoreRead) {
//     return; // write pending, ignore read.
//   }

//   console.log("We read a tag, but not during pending write!");
// };

// function write(data) {
//   ignoreRead = true;
//   return new Promise((resolve, reject) => {
//     ndef.addEventListener("reading", event => {
//       // Check if we want to write to this tag, or reject.
//       ndef.write(data).then(resolve, reject).finally(() => ignoreRead = false);
//     }, { once: true });
//   });
// }

// await ndef.scan();
// try {
//   await write("Hello World");
//   console.log("We wrote to a tag!")
// } catch(err) {
//   console.error("Something went wrong", err);
// }





let hr = new XMLHttpRequest();
let days = document.getElementById("days");
let trips = document.getElementById("trips");




// Когда прилетает ответ с сервера
hr.onreadystatechange = function() {
  if (hr.readyState == 4 && hr.status == 200) {
    var return_data = hr.response;
    var objee = JSON.parse(return_data);
    if (objee.code == 1) {
      var audio = new Audio('../media/classic_hurt.mp3');
      audio.play();
      var allElem = document.body.getElementsByClassName('badCardBlock');
      allElem[0].classList.add("active");
      setTimeout(
        () => {
          allElem[0].classList.remove("active");
        },
        3 * 1000
        );

    } else {
      const $elem1 = document.querySelector('#days');
      $elem1.textContent = 'Осталось дней: ' + objee.days;
      const $elem2 = document.querySelector('#trips');
      $elem2.textContent = 'Осталось поездок: ' + objee.tickets;
      var audio = new Audio('../media/nfc-sound.mp3');
      audio.play();

      const $elem3 = document.querySelector('#soldTickets');
      var soldTickets = Number($elem3.innerHTML) + 1;
      $elem3.textContent = soldTickets;
      
      // var allElem0 = document.body.getElementsByClassName('goodCardBlock');
      // allElem0[0].classList.remove("active");
      var allElem = document.body.getElementsByClassName('goodCardBlock');
      allElem[0].classList.add("active");
    }
  }
}




let text;
let el = document.getElementById('result');

var scanButton = document.getElementById("scanButton");




// Ждем клик по кнопке покупки nfc билета
scanButton.addEventListener("click", async () => {
  console.log("User clicked scan button");

  try {
    let controller = new AbortController();
    const ndef = new NDEFReader();
    await ndef.scan({signal: controller.signal});
    console.log("> Scan started");

    var allElem = document.body.getElementsByClassName('cardBlockBg');
    allElem[0].classList.add("active");
    
    // Ошибка чтения
    ndef.addEventListener("readingerror", () => {
      console.log("Argh! Cannot read data from the NFC tag. Try another one?");
      var audio = new Audio('../media/classic_hurt.mp3');
      audio.play();
      // var allElem0 = document.body.getElementsByClassName('goodCardBlock');
      // allElem0[0].classList.remove("active");
      var allElem = document.body.getElementsByClassName('badCardBlock');
      allElem[0].classList.add("active");
      setTimeout( () => { allElem[0].classList.remove("active"); }, 6 * 1000);
    });


    // Успешное чтоние
    ndef.addEventListener("reading", function readingEvent({ message, serialNumber }) {
      console.log(`> Serial Number: ${serialNumber}`);
      console.log(`> Records: (${message.records.length})`);
      
      // Успешня расшифровка
      try {
        const decoder = new TextDecoder(message.records[0].encoding);
        text = decoder.decode(message.records[0].data);
        console.log(text);
        var url = "../inc/checkTicket.inc.php";
        var dataPphp = document.querySelector('#id_route').innerHTML;

        var vars = "id="+serialNumber+"&pwd="+text+"&flight="+dataPphp;
        hr.open("POST", url, true);
        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        hr.send(vars);

        // Ошибка с расшифровкой
      } catch (error) {
        var audio = new Audio('../media/classic_hurt.mp3');
        audio.play();
        // var allElem0 = document.body.getElementsByClassName('goodCardBlock');
        // allElem0[0].classList.remove("active");
        var allElem = document.body.getElementsByClassName('badCardBlock');
        allElem[0].classList.add("active");
        setTimeout( () => { allElem[0].classList.remove("active"); }, 6 * 1000);
      }

      

    });

    var backButton = document.querySelector('.backBlockBorder');
      backButton.onclick = function(event) {
        var allElem = document.body.getElementsByClassName('cardBlockBg');
        allElem[0].classList.remove("active");
        var allElem1 = document.body.getElementsByClassName('badCardBlock');
        allElem1[0].classList.remove("active");
        var allElem2 = document.body.getElementsByClassName('goodCardBlock');
        allElem2[0].classList.remove("active");
        controller.abort();
      }

    // Нет NFC
  } catch (error) {
    console.log("Argh! " + error);
    var audio = new Audio('../media/classic_hurt.mp3');
    audio.play();
    var allElem = document.body.getElementsByClassName('nfcerror');
    allElem[0].classList.add("active");
    setTimeout( () => { allElem[0].classList.remove("active"); }, 6 * 1000);
  }
});




// var writeButton = document.getElementById("writeButton");

// writeButton.addEventListener("click", async () => {
//   console.log("User clicked write button");

//   try {
//     const ndef = new NDEFReader();
//     await ndef.write("Hello world!");
//     console.log("> Message written");
//   } catch (error) {
//     console.log("Argh! " + error);
//   }
// });

// var makeReadOnlyButton = document.getElementById("makeReadOnlyButton");

// makeReadOnlyButton.addEventListener("click", async () => {
//   console.log("User clicked make read-only button");

//   try {
//     const ndef = new NDEFReader();
//     await ndef.makeReadOnly();
//     console.log("> NFC tag has been made permanently read-only");
//   } catch (error) {
//     console.log("Argh! " + error);
//   }
// });

