import { useState } from 'react'

export default function Card() {
    //var count: number = 10
    const [counter, setCounter] = useState(10)
    const increment = () => {
        
        console.log('increment', counter)
        setCounter(counter + 1)
    }
  return (
    <>
        <h1>Card {counter}</h1>
        <button onClick={increment}>Click me bitch</button>
    </>
  );
}