import React from 'react';
import './App.sass';
import Welcome from './components/Welcome';
 const App: React.FC = () => {
  return (
    <div className="App">
      <div className="app">
        <Welcome />
      </div>
    </div>
  );
};

export default App;
