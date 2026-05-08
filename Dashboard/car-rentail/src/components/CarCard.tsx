/* components/CarCard.tsx
interface Car {
  brand_id:string,
  color:string,
  created_at:string,
  id:number,
  is_premium:boolean,
  lat:number,
  license_plate:string,
  lng:number,
  mileage:number,
  model:string,
  remember_token:string,
  rental_count:number,
  status:string,
  updated_at:string,
  year:number

  id: number;
  name: string;
  spec: string;
  image: string;
  distance: string;
  walkMin: number;
  rating: number;
  reviews: number;
  price: number;
}*/

import type Car from "../interfaces/Car"

interface CarCardProps {
  car: Car;
  favorited: boolean;
  onToggleFav: (id: number) => void;
}

export default function CarCard({ car, favorited, onToggleFav }: CarCardProps) {
  return (
    <div className="car-card">
      <div className="card-top-row">
        <div className="card-meta">
          <span className="meta-item">
            🚶 a <span className="muted">a</span>
          </span>
          <span className="meta-item">
            <span className="stars">★</span> a{" "}
            <span className="muted">a</span>
          </span>
        </div>
        <button className="fav-btn" onClick={() => onToggleFav(car.id)}>
          {favorited ? "❤️" : "🤍"}
        </button>
      </div>

      <img src="" alt={car.model} className="car-img" />

      <div className="card-bottom">
        <div>
          <div className="car-name">{car.model} {car.brand_id}</div>
          <div className="car-spec">{car.year}</div>
        </div>
        <div className="car-price">
          <span className="price-val">$a</span>
          <span className="price-unit"> / hour</span>
        </div>
      </div>
    </div>
  );
}
