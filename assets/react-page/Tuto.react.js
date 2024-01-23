import { useState } from "react";

function Greeting({ name }) {
  return (
    <div>
      <span className="square">{name}</span>
      <br />
    </div>
  );
}

function Alpha({ name, clicked }) {
  const [count, setCountByState] = useState(0);
  function handleClick() {
    // use commonClick instead
    setCountByState(count + 1);
    alert("You clicked " + name + " " + count + " !");
  }
  return (
    <button className="square" onClick={clicked}>
      {name}
    </button>
  );
}

const products = [
  { title: "Cabbage", id: 1 },
  { title: "Garlic", id: 2 },
  { title: "Apple", id: 3 },
];

const user = { name: "Tom" };
const base = [{ checkone: "two" }, { checktwo: "one" }];
let content = 32;

export default function App() {
  if (content === 32) {
    content = <div>{content}</div>;
  }

  const [common, setCommon] = useState(9);
  function commonClick() {
    setCommon(common + 1);
    alert("You commonly clicked " + common + " !");
  }

  return (
    <div>
      <Greeting name="world" />
      <Alpha name="alpha" clicked={commonClick} />
      <Alpha name="alpha2" clicked={commonClick} />
      {content ? content : "nope"}
      <h2
        style={{
          height: "34px",
          width: "32",
        }}
      ></h2>
      <h3 className="avatar">{user.name}</h3>
      <div>
        {products.map((p) => (
          <li
            key={p.id}
            style={{
              color: p.title === "Apple" ? "yellow" : "red",
            }}
          >
            {p.title}
          </li>
        ))}
      </div>
    </div>
  );
}
