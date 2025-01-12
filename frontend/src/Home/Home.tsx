import React from 'react';
import styles from './Home.module.sass';
import FeatureFlag, { FeaturesEnum } from '../FeatureToggle';

const Home: React.FC = () => {
  return (
    <div data-testid="home" className={styles.content}>
      <h1>Auction</h1>
      <FeatureFlag not name={FeaturesEnum.WeAreHere}>
        <p>We will be here soon!</p>
      </FeatureFlag>
      <FeatureFlag name={FeaturesEnum.WeAreHere}>
        <p>We are here</p>
      </FeatureFlag>
    </div>
  );
};

export default Home;
