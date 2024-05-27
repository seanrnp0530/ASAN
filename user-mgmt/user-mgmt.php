<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-compatible" content="IE-edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ASAN Web Administration</title>
    <link
      href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="\output.css" />
  </head>
  <body class="overflow-hidden">
    <nav class="bg-green-dark flex justify-between items-center w-full">
      <div class="px-12 py-8 flex items-start">
        <div class="flex items-center">
          <svg width="45" height="60" viewBox="0 0 26 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15.5 38V30.5M15.5 3L4.29705 15.6485C1.70093 18.5796 1.14726 22.7945 2.89833 26.2967V26.2967C3.29846 27.0969 3.77667 27.8557 4.32598 28.562L5.25 29.75L7 32M15.5 3V30.5M15.5 3L23 13.5L23.8515 15.0327C24.8467 16.824 24.6481 19.0412 23.3505 20.6271L23.2945 20.6957C21.7751 22.5527 19.9621 24.1487 17.9274 25.4204L17 26M15.5 30.5L7.5 20.5" stroke="white" stroke-width="3" stroke-linecap="round"/>
          </svg>
        
          <div class="ml-2 flex flex-col">
            <div class="text-2xl font-bold text-white font-inter">Project ASANA<br></div>
            <div class="text-md font-semibold text-white font-inter">Administration</div>
          </div>
        </div>
      </div>

      <div class="px-12 py-8 flex items-center text-white font-Inter">
        <svg class="w-9 h-9 mr-2" xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24">
          <path fill="white" d="M14.945 1.25c-1.367 0-2.47 0-3.337.117c-.9.12-1.658.38-2.26.981c-.524.525-.79 1.17-.929 1.928c-.135.737-.161 1.638-.167 2.72a.75.75 0 0 0 1.5.008c.006-1.093.034-1.868.142-2.457c.105-.566.272-.895.515-1.138c.277-.277.666-.457 1.4-.556c.755-.101 1.756-.103 3.191-.103h1c1.436 0 2.437.002 3.192.103c.734.099 1.122.28 1.4.556c.276.277.456.665.555 1.4c.102.754.103 1.756.103 3.191v8c0 1.435-.001 2.436-.103 3.192c-.099.734-.279 1.122-.556 1.399c-.277.277-.665.457-1.399.556c-.755.101-1.756.103-3.192.103h-1c-1.435 0-2.436-.002-3.192-.103c-.733-.099-1.122-.28-1.399-.556c-.243-.244-.41-.572-.515-1.138c-.108-.589-.136-1.364-.142-2.457a.75.75 0 1 0-1.5.008c.006 1.082.032 1.983.167 2.72c.14.758.405 1.403.93 1.928c.601.602 1.36.86 2.26.982c.866.116 1.969.116 3.336.116h1.11c1.368 0 2.47 0 3.337-.116c.9-.122 1.658-.38 2.26-.982c.602-.602.86-1.36.982-2.26c.116-.867.116-1.97.116-3.337v-8.11c0-1.367 0-2.47-.116-3.337c-.121-.9-.38-1.658-.982-2.26c-.602-.602-1.36-.86-2.26-.981c-.867-.117-1.97-.117-3.337-.117z" />
          <path fill="white" d="M15 11.25a.75.75 0 0 1 0 1.5H4.027l1.961 1.68a.75.75 0 1 1-.976 1.14l-3.5-3a.75.75 0 0 1 0-1.14l3.5-3a.75.75 0 1 1 .976 1.14l-1.96 1.68z" />
        </svg>
        <a href="\public\login-authentication.html" class="text-2xl m-0 font-bold"> Logout </a>
      </div>
    </nav>

    <div class="flex flex-row flex-auto">
      
      <div class="flex flex-row h-screen w-64 bg-xanadu-400 text-white">
        <div class="flex flex-col flex-auto">

          <div class="pl-5 py-4 mt-10 text-sm flex items-center bg-green-dark border-t-2 border-b-2 border-white">
            <svg class="w-12 h-12 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" viewBox="0 0 24 24">
              <path fill-rule="evenodd" d="M12 20a7.966 7.966 0 0 1-5.002-1.756l.002.001v-.683c0-1.794 1.492-3.25 3.333-3.25h3.334c1.84 0 3.333 1.456 3.333 3.25v.683A7.966 7.966 0 0 1 12 20ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10c0 5.5-4.44 9.963-9.932 10h-.138C6.438 21.962 2 17.5 2 12Zm10-5c-1.84 0-3.333 1.455-3.333 3.25S10.159 13.5 12 13.5c1.84 0 3.333-1.455 3.333-3.25S13.841 7 12 7Z" clip-rule="evenodd"/>
            </svg>
            <a href="/user-mgmt/user-mgmt.php" class="text-xl font-bold"> Users </a>
          </div>

          <div class="pl-5 py-4 text-sm flex items-center hover:bg-green-dark hover:border-y-2 border-white">
            <svg class="w-12 h-12 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" viewBox="0 0 24 24">
              <path fill-rule="evenodd" d="M15 7a2 2 0 1 1 4 0v4a1 1 0 1 0 2 0V7a4 4 0 0 0-8 0v3H5a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2V7Zm-5 6a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-3a1 1 0 0 1 1-1Z" clip-rule="evenodd"/>
            </svg>
            <a href="/security/security.php" class="text-xl font-bold"> Security </a>
          </div>

          <div class="pl-5 py-4 text-sm flex items-center hover:bg-green-dark hover:border-y-2 border-white">
            <svg class="w-12 h-12 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" viewBox="0 0 24 24">
              <path fill-rule="evenodd" d="M4 4a2 2 0 0 0-2 2v12a2 2 0 0 0 .087.586l2.977-7.937A1 1 0 0 1 6 10h12V9a2 2 0 0 0-2-2h-4.532l-1.9-2.28A2 2 0 0 0 8.032 4H4Zm2.693 8H6.5l-3 8H18l3-8H6.693Z" clip-rule="evenodd"/>
            </svg>
            <a href="/applications/applications.php" class="text-xl font-bold"> Applications </a>
          </div>

        </div>
      </div>

      <div class="flex flex-col flex-1 bg-eggshell p-8"> 
       
        <input type="text" id="search-bar" class="px-4 py-2 w-64 rounded-md border border-gray-300" placeholder="Search..." oninput="filterTable()">
        
        <div class="flex flex-row mt-5 justify-center items-center mx-auto shadow-md text-green-dark">
          <table>
            <thead>
              <tr>
                <th class="px-20 py-2 bg-green-dark text-white">Picture</th>
                <th class="px-20 py-2 bg-green-dark text-white">Name</th>
                <th class="px-20 py-2 bg-green-dark text-white">Email</th>
                <th class="px-20 py-2 bg-green-dark text-white">Role</th>
                <th class="px-12 py-2 bg-green-dark text-white">Deactivate</th>
              </tr>
            </thead>
            <tbody id="table-body">
              <?php
                include ("fetch_data.php");
              ?>
            </tbody>
          </table>
        </div>

        <div class="flex mb-5 justify-end">
          <div class="pagination" id="pagination-controls">
            <?php
              include ("pagination_controls.php");
            ?>
          </div>
        </div>

      </div>
      </div>
    </div>

  </body>
</html>

<script>
      function filterTable() {
        // Declare variables
        var input, filter, table, tr, tdName, tdRole, i, txtValueName, txtValueRole;
        input = document.getElementById("search-bar");
        filter = input.value.toUpperCase();
        table = document.getElementById("table-body");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those that don't match the search query
        for (i = 0; i < tr.length; i++) {
          tdName = tr[i].getElementsByTagName("td")[1]; // Index 1 represents the column with the name
          tdRole = tr[i].getElementsByTagName("td")[3]; // Index 3 represents the column with the role
          if (tdName && tdRole) {
            txtValueName = tdName.textContent || tdName.innerText;
            txtValueRole = tdRole.textContent || tdRole.innerText;
            if (txtValueName.toUpperCase().indexOf(filter) > -1 || txtValueRole.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";
            } else {
              tr[i].style.display = "none";
            }
          }
        }
      }
    </script>


