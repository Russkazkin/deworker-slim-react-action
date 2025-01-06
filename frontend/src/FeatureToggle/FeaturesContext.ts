import { createContext } from 'react';

export interface FeaturesContextState {
  features: string[];
}

const FeaturesContext = createContext<FeaturesContextState>({ features: [] });
export default FeaturesContext;
