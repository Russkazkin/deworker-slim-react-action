import React, { useContext } from "react";
import styles from './Welcome.module.sass';
import { FeaturesContext } from "../FeatureToggle";

const Welcome: React.FC = () => {
  const { features } = useContext(FeaturesContext);
  return (
    <div data-test="welcome" className={styles.welcome}>
      <h1>Auction</h1>
      {features.includes('WE_ARE_HERE') ? (
        <p>We are here</p>
      ) : (
        <p>We will be here soon</p>
      )}
    </div>
  );
};

export default Welcome;
