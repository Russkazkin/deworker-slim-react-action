import React from 'react';
import './App.sass';
import Welcome from '../Welcome';
import { FeaturesContext } from '../FeatureToggle';

type Props = {
  features: string[];
};

const App: React.FC<Props> = ({ features }) => {
  return (
    <FeaturesContext.Provider value={{ features }}>
      <div className="App">
        <div className="app">
          <Welcome />
        </div>
      </div>
    </FeaturesContext.Provider>
  );
};

export default App;
