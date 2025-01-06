import React, { ReactNode } from 'react';
import FeaturesContext from './FeaturesContext';

type Props = {
  features: string[];
  children: ReactNode;
};

const FeaturesProvider: React.FC<Props> = ({ features, children }) => {
  return (
    <FeaturesContext.Provider value={{features}}>
      {children}
    </FeaturesContext.Provider>
  )
};

export default FeaturesProvider;
