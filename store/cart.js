const sell = document.querySelector(".sell");
const sale = document.querySelector(".sale");
const cancelbtn = document.querySelector("#cancelbtn");
const pop = document.querySelector("#pop");
const overlay = document.querySelector("#overlay");

sell.onclick = () => {
  sale.classList.toggle("active");
};
//CANCEL FOR POP UP
cancelbtn.onclick = () => {
  pop.classList.remove("active");
  overlay.classList.remove("active");
};

const img = document.querySelector("#image");
const namie = document.querySelector("#name");
const price = document.querySelector("#price");
const qty = document.querySelector("#qty");
const treeId = document.querySelector("#ided");
const addBtn = document.querySelector("#addbtn");

// Storing products added to cart on the user's device local storage USING INDEXEDDB

// Create an instance of a db object for us to store the open database in
let db;
// Open our database
const openRequest = window.indexedDB.open("tree_db", 1);
// error handler signifies that the database didn't open successfully
openRequest.addEventListener("error", () =>
  console.error("Database failed to open")
);

// success handler signifies that the database opened successfully
openRequest.addEventListener("success", () => {
  console.log("Database opened successfully");

  // Store the opened database object in the db variable. This is used a lot below
  db = openRequest.result;

  // Run the displayData() and getAllCarItems() function to get the notes already in the IDB
  displayData();
  getAllCartItems();
});

// Set up the database tables if this has not already been done
openRequest.addEventListener("upgradeneeded", (e) => {
  // Grab a reference to the opened database
  db = e.target.result;

  // Create an objectStore to store our notes in (basically like a single table)
  // including a auto-incrementing key
  const objectStore = db.createObjectStore("tree", {
    keyPath: "id",
    autoIncrement: true,
  });

  // Define what data items the objectStore will contain
  objectStore.createIndex("image", "image", { unique: false });
  objectStore.createIndex("name", "name", { unique: false });
  objectStore.createIndex("price", "price", { unique: false });
  objectStore.createIndex("qty", "qty", { unique: false });
  objectStore.createIndex("treeId", "treeId", { unique: false });

  console.log("Database setup complete");
});

// Create a cick event handler so that when addbtn is clicked the addData() function is run
addBtn.addEventListener("click", addData);

// Define the addData() function
function addData(e) {
  // prevent default - we don't want the anchor tag to click in the conventional way
  e.preventDefault();

  // grab the values from the fields and store them in an object ready for being inserted into the DB
  const newItem = {
    image: img.getAttribute("src"),
    name: namie.textContent,
    price: price.textContent,
    qty: qty.value,
    treeId: treeId.value,
  };

  // open a read/write db transaction, ready for adding the data
  const transaction = db.transaction(["tree"], "readwrite");

  // call an object store that's already been added to the database
  const objectStore = transaction.objectStore("tree");

  // Make a request to add our newItem object to the object store
  const addRequest = objectStore.add(newItem);

  addRequest.addEventListener("success", () => {
    console.log("newItems added.");
  });

  // Report on the success of the transaction completing, when everything is done
  transaction.addEventListener("complete", () => {
    console.log("Transaction completed: database modification finished.");

    //popup should disappear after adding tree to the db
    pop.classList.remove("active");
    overlay.classList.remove("active");
    //animation fot cart number to drop down when new item is added
    const top = document.querySelector(".top");
    top.style.display = "none";
    setTimeout(() => {
      top.style.display = "block";
    }, 1200);
    getAllCartItems();
    displayData();
  });

  transaction.addEventListener("error", () =>
    console.log("Transaction not opened due to error")
  );
}

//Declaring the HTML elements for cart.php page
const tbody = document.querySelector("#body");
// get the elements from cart.php
let subTotal = document.querySelector("#sub");
let tax = document.querySelector("#tax");
let total = document.querySelector("#total");
let allProductsInfo = document.querySelector("#products_info");
let totalPrice = document.querySelector("#totalPrice");

// Define the displayData() function
function displayData() {
  // Here we empty the contents of the table body (tbody) element each time the display is updated
  // If you didn't do this, you'd get cart duplicates listed each time a new cart is added
  while (tbody.firstChild) {
    tbody.removeChild(tbody.firstChild);
  }

  // Open our object store and then get a cursor - which iterates through all the
  // different data items in the store
  const objectStore = db.transaction("tree").objectStore("tree");
  objectStore.openCursor().addEventListener("success", (e) => {
    // Get a reference to the cursor
    const cursor = e.target.result;

    // If there is still another data item to iterate through, keep running this code
    if (cursor) {
      // Create a table body item, h3, and p to put each data item inside when displaying it
      // structure the HTML fragment, and append it inside the tbody

      // table row
      const trow = document.createElement("tr");
      // product column
      const data1 = document.createElement("td");
      // Quantity column
      const data2 = document.createElement("td");
      //Amount column
      const data4 = document.createElement("td");
      // contents of product column
      const imge = document.createElement("img");
      const section = document.createElement("div");
      const nam = document.createElement("h5");
      const pric = document.createElement("h5");

      // styling elements
      data1.style.overflow = "hidden";
      data1.style.display = "flex";
      data1.style.justifyContent = "left";
      data1.style.alignItems = "center";
      data1.style.padding = "5px";
      data2.style.padding = "10px";
      data2.style.fontSize = "11px";
      data2.style.fontWeight = "bold";
      data2.style.color = "red";
      section.style.display = "flex";
      section.style.flexDirection = "column";
      section.style.justifyContent = "center";
      section.style.alignItems = "center";
      trow.style.backgroundColor = "rgba(0, 0, 0, 0.015)";
      data4.style.fontSize = "11px";
      data4.style.fontWeight = "bold";

      imge.style.width = "80px";
      imge.style.height = "80px";
      imge.style.borderRadius = "5px";
      nam.style.padding = "5px";
      pric.style.padding = "5px";
      pric.style.color = "red";
      nam.style.fontSize = "11px";
      nam.style.fontWeight = "bold";
      pric.style.fontSize = "11px";
      pric.style.fontWeight = "bold";

      data1.appendChild(imge);
      data1.appendChild(section);
      section.appendChild(nam);
      section.appendChild(pric);
      trow.appendChild(data1);
      trow.appendChild(data2);
      trow.appendChild(data4);
      tbody.appendChild(trow);

      // Put the data from the cursor inside the table body data(td)
      imge.setAttribute("src", cursor.value.image);
      nam.textContent = cursor.value.name;
      pric.textContent = cursor.value.price;
      data2.textContent = cursor.value.qty;

      //display amount in data4 by multiplying qty and price
      calPrice = cursor.value.price.slice(1);
      data4.textContent = "$" + `${calPrice * cursor.value.qty}`;
      //Loop through all data4 to get its content
      trow.classList.add("row");
      let rows = document.querySelectorAll(".row");
      let data4Array = Array.from(rows).map((items) => {
        return parseInt(items.childNodes[2].innerHTML.slice(1));
      });
      //sum the contents of the array
      let sum = 0;
      for (let i = 0; i < data4Array.length; i++) {
        sum += data4Array[i];
      }
      //let tax be 1% of the subtotal and round off to 2 decimal places
      let num = 0.01 * sum;
      const taxs = num.toFixed(2);
      // let total be the sum of subtotal and tax
      let totals = num + sum;
      // display sum in subtotal field
      subTotal.textContent = "$" + sum;
      // display taxs in tax field
      tax.textContent = "$" + taxs;
      // display totals in total field
      total.textContent = "$" + totals;
      // display totals in price field
      totalPrice.value = totals;

      // Store the ID of the data item inside an attribute on the trow, so we know
      // which trow (tr) it corresponds to. This will be useful later when we want to delete items
      trow.setAttribute("data-note-id", cursor.value.id);

      // Create a button and place it inside each data1 in the trow
      const deleteBtn = document.createElement("button");
      trow.appendChild(deleteBtn);
      deleteBtn.innerHTML = "&times;";
      deleteBtn.style.fontSize = "30px";
      deleteBtn.style.backgroundColor = "transparent";
      deleteBtn.style.padding = "3px";
      // deleteBtn.style.borderRadius = "5px";
      deleteBtn.style.border = "none";
      deleteBtn.style.color = "black";
      deleteBtn.style.fontWeight = "normal";
      deleteBtn.style.marginBottom = "10px";

      // Set an event handler so that when the button is clicked, the deleteItem()
      // function is run
      deleteBtn.addEventListener("click", deleteItem);

      // Iterate to the next item in the cursor
      cursor.continue();
    } else {
      // Again, if list item is empty, display a 'No notes stored' message
      if (!tbody.firstChild) {
        const trow = document.createElement("tr");
        trow.textContent = "No tree in cart added yet.";
        tbody.appendChild(trow);

        //if list is empy set these to zero
        subTotal.textContent = "$" + 0;
        tax.textContent = "$" + 0;
        total.textContent = "$" + 0;
        totalPrice.value = 0;
      }
      // if there are no more cursor items to iterate through, say so
      console.log("Notes all displayed");
    }
  });
}

// Define the deleteItem() function
function deleteItem(e) {
  // retrieve the name of the task we want to delete. We need
  // to convert it to a number before trying to use it with IDB; IDB key
  // values are type-sensitive.
  const noteId = Number(e.target.parentNode.getAttribute("data-note-id"));

  // open a database transaction and delete the task, finding it using the id we retrieved above
  const transaction = db.transaction(["tree"], "readwrite");
  const objectStore = transaction.objectStore("tree");
  const deleteRequest = objectStore.delete(noteId);

  // report that the data item has been deleted
  transaction.addEventListener("complete", () => {
    // delete the parent of the button
    // which is the list item, so it is no longer displayed
    e.target.parentNode.parentNode.removeChild(e.target.parentNode);
    console.log(`Note ${noteId} deleted.`);

    // call the displayData function again so we call update subTotal, tax and total when an item is deleted
    // and so we can redisplay the cart items
    getAllCartItems();
    displayData();

    //Again, if tbody is empty, display a 'No notes stored' message
    /*if (!tbody.firstChild) {
      const trow = document.createElement("tr");
      trow.textContent = "Cart is empty.";
      tbody.appendChild(trow);
    }*/
  });
}

// Get an array with all the data in objectStore
function getAllCartItems() {
  const request = db.transaction("tree").objectStore("tree").getAll();

  request.onsuccess = () => {
    const items = request.result;
    console.log(items);

    //get number of items in cart
    document.querySelector(".cartNum").textContent = items.length;
    // display all the products in allProductsInfo
    allProductsInfo.value = JSON.stringify(items);
  };
  request.onerror = (err) => {
    console.error(`Error to ge all items: ${err}`);
  };
}
