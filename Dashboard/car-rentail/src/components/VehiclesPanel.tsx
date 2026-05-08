// components/VehiclesPanel.tsx
import { useEffect,useState } from "react";
import CarCard from "./CarCard";
import axios from "axios";
import type Car from "../interfaces/Car"

/*const cars = [
  {
    id: 1,
    name: "Audi A4",
    spec: "2.0 TFSI Sport (249 hp, Quattro)",
    price: 24.59,
    distance: "120m",
    walkMin: 4,
    rating: 4.7,
    reviews: 109,
    image: "https://images.unsplash.com/photo-1606664515524-ed2f786a0bd6?auto=format&fit=crop&q=80&w=800",
    favorited: false,
  },
  {
    id: 2,
    name: "Opel Insignia",
    spec: "2.0 Turbo Grand Sport (230 hp, AWD)",
    price: 19.99,
    distance: "250m",
    walkMin: 8,
    rating: 4.0,
    reviews: 87,
    image: "https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&q=80&w=800",
    favorited: false,
  },
  {
    id: 3,
    name: "Mazda 6",
    spec: "2.5 Turbo Premium (250 hp, AWD)",
    price: 22.99,
    distance: "90m",
    walkMin: 3,
    rating: 5.0,
    reviews: 766,
    image: "https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?auto=format&fit=crop&q=80&w=800",
    favorited: true,
  },
];
*/
interface VehiclesPanelProps {
  favorites: Record<number, boolean>;
  onToggleFav: (id: number) => void;
}

export default function VehiclesPanel({ favorites, onToggleFav }: VehiclesPanelProps) {
  const [cars, setCars] = useState([])

  useEffect(()=>{
    getCars()
  })

  const getCars = () =>{
    axios.get("http://localhost:8000/api/cars").then((response:any)=>{
        console.log(response.data.data)
        setCars(response.data.data)
    }).catch((error:any)=>{
      console.log(error)
    })
  }

  return (
    <section className="vehicles-panel">
      <div className="vehicles-header">
        <span className="vehicles-count">48 vehicles to rent</span>
        <div className="vehicles-actions">
          <button className="sort-btn">Closest to me ▾</button>
          <button className="hide-map-btn">Hide map 🗺</button>
        </div>
      </div>

      {cars.map((car) => (
        <CarCard
          key={car.id}
          car={car}
          favorited={favorites[car.id]}
          onToggleFav={onToggleFav}
        />
      ))}
    </section>
  );
}
