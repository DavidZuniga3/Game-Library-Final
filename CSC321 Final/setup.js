fetch("games.json")
.then(response => response.json())
.then(function(data){
    setupGrid(data);
});

function setupGrid(gamesList)
{
    let grid = document.getElementById("grid");

    for(let i = 0; i < gamesList.length; i++)
    {
        let game = gamesList[i];
        grid.innerHTML += `
        <div class = "cell"> <a href = "gameDesc.html?id=` + game.id + `">` + `<img src = "` + game.image + `" <h3>` + game.title + `</h3>` + ` </div>`;
    }

}
