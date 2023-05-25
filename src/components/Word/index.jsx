import "./index.scss";
import Draggable from "react-draggable";

export default function Word({ children, left, top }) {
  return (
    <Draggable
      bounds="parent"
      axis="both"
      defaultPosition={{ x: top, y: left }}
    >
      <span className="word">{children}</span>
    </Draggable>
  );
}
