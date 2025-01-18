import React from 'react';
import FeatureFlag, { FeaturesEnum } from '../FeatureToggle';
import System from '../Layout/System';

const Home: React.FC = () => {
  return (
    <System>
      <h1>Auction</h1>
      <FeatureFlag not name={FeaturesEnum.JoinToUs}>
        <p>We will be here soon!</p>
      </FeatureFlag>
      <FeatureFlag name={FeaturesEnum.JoinToUs}>
        <p>We are here</p>
      </FeatureFlag>
    </System>
  );
};

export default Home;
