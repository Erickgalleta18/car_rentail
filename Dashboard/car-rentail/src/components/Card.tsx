import { use, useState } from "react"

export default function Card(){

    var cont:number=0
    const [contador, setContador] = useState(0) 

    const aumentar = ()=>{
            console.log("Neiga",cont)
            cont++
            setContador(contador+1) 
   }


    return (
        <>
            <h1>Card {contador}</h1>
            <button onClick={aumentar}>Hola</button>
        </>
    ) 
}