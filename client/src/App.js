import logo from './logo.svg';
import './App.css';
import LoginForm from './Components/Login/Login';
import RegisterForm from './Components/Register/Register';

function App() {
  return (
    <div className="App">
      <header className="App-header">
        <div>
          <h1>Mon Application</h1>
          <LoginForm />
          <RegisterForm />
        </div>
      </header>
    </div>
  );
}

export default App;
