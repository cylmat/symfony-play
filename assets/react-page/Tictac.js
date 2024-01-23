import { useState } from "react";

function Square({ value, onClick }) {
  /*const [value, setValue] = useState(null);
  function handleClick() {
    setValue("X");
  }*/
  /* onClick={handleClick}> */
  return (
    <button className="square" onClick={onClick}>
      {value}
    </button>
  );
} // -square

function Board({ xIsNext, squares, onPlay }) {
  // -const [xIsNext, setXIsNext] = useState(true);
  // -const [squares, setSquares] = useState(Array(9).fill(null));

  const winner = calculateWinner(squares);
  let status;

  function handleClick(i) {
    if (squares[i] || calculateWinner(squares)) {
      return;
    }

    // IMMUTABILITY !
    const updates = squares.slice(); // create copy instead of modify
    updates[i] = xIsNext ? "X" : "O";

    // -setSquares(updates);
    // -setXIsNext(!xIsNext);
    onPlay(updates);
    //console.log(updates.slice());
  }

  status = winner ? "Winner " + winner : "Next " + (xIsNext ? "X" : "O");

  return (
    <>
      <div className="board-row">
        <Square value={squares[0]} onClick={() => handleClick(0)} />
        <Square value={squares[1]} onClick={() => handleClick(1)} />
        <Square value={squares[2]} onClick={() => handleClick(2)} />
      </div>
      <div className="board-row">
        <Square value={squares[3]} onClick={() => handleClick(3)} />
        <Square value={squares[4]} onClick={() => handleClick(4)} />
        <Square value={squares[5]} onClick={() => handleClick(5)} />
      </div>
      <div className="board-row">
        <Square value={squares[6]} onClick={() => handleClick(6)} />
        <Square value={squares[7]} onClick={() => handleClick(7)} />
        <Square value={squares[8]} onClick={() => handleClick(8)} />
      </div>
      <div className="status">{status}</div>
    </>
  );
} // -board

export default function Game() {
  const [xIsNext, setXIsNext] = useState(true);
  const [history, setHistory] = useState([Array(9).fill(null)]);
  const currentSquares = history[history.length - 1];

  function handlePlay(next) {
    setXIsNext(!xIsNext);
    setHistory([...history, next]);
  }
  const historyList = history.map((sq, i) => {
    let mvList;
    return (
      <li key="i">
        <span>{sq.join("-")}</span>
      </li>
    );
  });

  return (
    <div className="game">
      <div className="board">
        <Board xIsNext={xIsNext} squares={currentSquares} onPlay={handlePlay} />
      </div>
      <div className="info">
        <ol>{historyList}</ol>
      </div>
    </div>
  );
} // -games

function calculateWinner(squares) {
  const lines = [
    [0, 1, 2],
    [3, 4, 5],
    [6, 7, 8],
    [0, 3, 6],
    [1, 4, 7],
    [2, 5, 8],
    [0, 4, 8],
    [2, 4, 6],
  ];
  for (let i = 0; i < lines.length; i++) {
    const [a, b, c] = lines[i];
    if (squares[a] === squares[b] && squares[a] === squares[c]) {
      return squares[a];
    }
  }
  return null;
}
