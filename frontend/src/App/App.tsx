import React from 'react';
import './App.sass';
import Welcome from '../Welcome';

type Props = {
  features: string[];
};

const App: React.FC<Props> = ({ features }) => {
  return (
    <div className="App">
      <div className="app">
        <Welcome features={features} />
      </div>
    </div>
  );
};

export default App;
